<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Client\Request;

class InvoiceController extends Controller {
    public function index() {

        return view( 'invoice.index' )->with( [
            'invoices' => invoice::latest()->paginate( 10 ),
        ] );
    }

    public function create() {

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
