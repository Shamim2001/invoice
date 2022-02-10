<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\invoice;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller {
    public function index() {

        return view( 'invoice.index' )->with( [
            'invoices' => invoice::with( 'client' )->latest()->paginate( 10 ),
        ] );
    }

    public function create() {

        return view( 'invoice.create' )->with( [

            'clients' => Client::where( 'user_id', Auth::user()->id )->get(),
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
}
