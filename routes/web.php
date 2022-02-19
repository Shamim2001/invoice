<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// backend

Route::prefix( '/' )->middleware( ['auth'] )->group( function () {

    Route::get( 'dashboard', function () {
        return view( 'dashboard' );
    } )->name( 'dashboard' );

    // client resource route
    Route::resource( 'client', ClientController::class );

    // search client route
    Route::get( 'client/{client:username}', [ClientController::class, 'searchTaskByClient'] )->name( 'task.search' );

    // task route
    Route::resource( 'task', TaskController::class );
    Route::put( 'task/{task}/complete', [TaskController::class, 'markAsComplete'] )->name( 'markAsComplete' );

    // invoices route
    Route::prefix( 'invoices' )->group( function () {
        Route::get( '/', [InvoiceController::class, 'index'] )->name( 'invoice.index' );
        Route::get( '/create', [InvoiceController::class, 'create'] )->name( 'invoice.create' );
        Route::put( '/{invoice}/update', [InvoiceController::class, 'update'] )->name( 'invoice.update' );
        Route::delete( '/{invoice}/destroy', [InvoiceController::class, 'destroy'] )->name( 'invoice.destroy' );
        Route::get( '/preview', [InvoiceController::class, 'preview'] )->name( 'preview.invoice' );
        Route::get( '/generate', [InvoiceController::class, 'generate'] )->name( 'invoice.generate' );
    } );

} );

require __DIR__ . '/auth.php';
