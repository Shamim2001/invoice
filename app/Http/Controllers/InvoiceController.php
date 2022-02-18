<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\invoice;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller {
    public function index() {

        return view( 'invoice.index' )->with( [
            'invoices' => invoice::with( 'client' )->latest()->paginate( 10 ),
        ] );
    }

    public function create() {

        return view( 'invoice.create' )->with( [

            'clients' => Client::where( 'user_id', Auth::user()->id )->get(),
            'tasks'   => false,
        ] );
    }

    public function edit() {

    }

    public function store( Request $request ) {

    }

    public function update( Request $request, Invoice $invoice ) {

    }

    public function show( Invoice $invoice ) {

    }

    public function destroy( Invoice $invoice ) {

    }

    public function search( Request $request ) {

        $request->validate( [
            'client_id' => ['required', 'not_in:none'],
            'status'    => ['required', 'not_in:none'],
        ] );

        return view( 'invoice.create' )->with( [

            'clients' => Client::where( 'user_id', Auth::user()->id )->get(),
            'tasks'   => $this->getInvoiceData( $request ),
        ] );
    }

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

    // preview
    public function preview( Request $request ) {

        return view( 'invoice.preview' )->with( [
            'invoice_no' => 'INVO_' . rand( 234565, 23568533 ),
            'user'       => Auth::user(),
            'tasks'      => $this->getInvoiceData( $request ),
        ] );
    }

    // generate
    public function generate( Request $request ) {

        $invo_no = 'INVO_' . rand( 234565, 23568533 );
        $data = [
            'invoice_no' => $invo_no,
            'user'       => Auth::user(),
            'tasks'      => $this->getInvoiceData( $request ),
        ];

        $pdf = PDF::loadView( 'invoice.pdf', $data );

        // store pdf in storage
        Storage::put( 'public/invoices/' . $invo_no . '.pdf', $pdf->output() );

        // Insert Inovice Data
        Invoice::create( [
            'invoice_id'   => $invo_no,
            'client_id'    => $request->client_id,
            'user_id'      => Auth::user()->id,
            'status'       => 'unpaid',
            'download_url' => $invo_no . '.pdf',
        ] );

        return redirect()->route( 'invoice.index' )->with( 'success', 'Invoice Created' );
    }
}
