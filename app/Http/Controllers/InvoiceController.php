<?php

namespace App\Http\Controllers;

use App\Jobs\InvoiceEmailJob;
use App\Models\Client;
use App\Models\invoice;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller {

    /**
     * Invoice index
     */
    public function index() {

        return view( 'invoice.index' )->with( [
            'invoices' => invoice::with( 'client' )->latest()->paginate( 10 ),
        ] );
    }

    /**
     * @panam Request
     * create function
     */
    public function create( Request $request ) {

        $tasks = false;

        // if to client_id & status
        if ( !empty( $request->client_id ) && !empty( $request->status ) ) {
            $request->validate( [
                'client_id' => ['required', 'not_in:none'],
                'status'    => ['required', 'not_in:none'],
            ] );

            $tasks = $this->getInvoiceData( $request );
        }

        return view( 'invoice.create' )->with( [

            'clients' => Client::where( 'user_id', Auth::user()->id )->get(),
            'tasks'   => $tasks,
        ] );
    }

    /**
     * @panam Request, Invoice
     * update invoice status to paid
     */
    public function update( Request $request, Invoice $invoice ) {

        $invoice->update( [
            'status' => 'paid',

        ] );

        return redirect()->route( 'invoice.index' )->with( 'success', 'Invoice payment paided!' );
    }

    /**
     * @function destroy
     * delete invoice info
     */
    public function destroy( Invoice $invoice ) {

        Storage::delete( 'public/invoices/' . $invoice->download_url );
        $invoice->delete();

        return redirect()->route( 'invoice.index' )->with( 'success', 'Invoice has been Deleted!' );
    }

    /**
     * @function Get Invoice Data
     * return Tasks
     */
    public function getInvoiceData( Request $request ) {

        $tasks = Task::latest();

        if ( !empty( $request->client_id ) ) {
            $tasks = $tasks->where( 'client_id', '=', $request->client_id );
        }

        if ( !empty( $request->status ) ) {
            $tasks = $tasks->where( 'status', '=', $request->status );
        }

        if ( !empty( $request->formDate ) ) {
            $tasks = $tasks->whereDate( 'created_at', '>=', $request->formDate );
        }

        if ( !empty( $request->endDate ) ) {
            $tasks = $tasks->whereDate( 'created_at', '<=', $request->endDate );
        }
        return $tasks->get();
    }

    public function invoice( Request $request ) {

        if ( !empty( $request->generate ) && $request->generate == 'yes' ) {
            $this->generate( $request );

            return redirect()->route( 'invoice.index' )->with( 'success', 'Invoice Created' );
        }

        if ( !empty( $request->preview ) && $request->preview == 'yes' ) {

            $tasks = Task::whereIn( 'id', $request->invoice_ids )->get();
            return view( 'invoice.preview' )->with( [
                'invoice_no' => 'INVO_' . rand( 234565, 23568533 ),
                'user'       => Auth::user(),
                'tasks'      => $tasks,
            ] );

        }
    }

    /**
     * function generation
     * PDF generation
     * invoice insert
     */
    public function generate( Request $request ) {

        $invo_no = 'INVO_' . rand( 234565, 23568533 );
        $tasks = Task::whereIn( 'id', $request->invoice_ids )->get();

        $data = [
            'invoice_no' => $invo_no,
            'user'       => Auth::user(),
            'tasks'      => $tasks,
        ];

        // pdf generate
        $pdf = PDF::loadView( 'invoice.pdf', $data );

        // store pdf in storage
        Storage::put( 'public/invoices/' . $invo_no . '.pdf', $pdf->output() );

        // Insert Inovice Data
        Invoice::create( [
            'invoice_id'   => $invo_no,
            'client_id'    => $tasks->first()->client->id,
            'user_id'      => Auth::user()->id,
            'status'       => 'unpaid',
            'download_url' => $invo_no . '.pdf',
        ] );

    }

    // send email
    public function sendEmail( Invoice $invoice ) {

        // $pdf = Storage::get( 'public/invoices/' . $invoice->download_url );

        $data = [
            'user'       => Auth::user(),
            'invoice_id' => $invoice->invoice_id,
            'invoice'    => $invoice,
            // 'pdf'        => $pdf,
        ];

        // InvoiceEmailJob::dispatch( $data );
        dispatch( new InvoiceEmailJob( $data ) );

        // Mail::send( 'emails.invoice', $data, function ( $message ) use ( $invoice, $pdf ) {
        //     $message->from( Auth::user()->email, Auth::user()->name );
        //     $message->to( $invoice->client->email, $invoice->client->name );
        //     $message->subject( $invoice->invoice_id );
        //     $message->attachData( $pdf, $invoice->download_url, [
        //         'mime' => 'application/pdf',
        //     ] );

        // } );

        $invoice->update( [
            'email_sent' => 'yes',
        ] );

        return redirect()->route( 'invoice.index' )->with( 'success', 'Email Send' );
    }
}
