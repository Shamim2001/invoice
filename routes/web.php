<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// frontend

Route::get( '/', function () {
    return view( 'welcome' );
} );

// backend

Route::get( '/dashboard', function () {
    return view( 'dashboard' );
} )->middleware( ['auth'] )->name( 'dashboard' );

Route::prefix( 'dashboard' )->middleware( ['auth'] )->group( function () {

    Route::get( '/', function () {
        return view( 'dashboard' );
    } )->name( 'dashboard' );

    Route::resource( 'client', ClientController::class );

    Route::get( 'task/client/{client:username}', [ClientController::class, 'searchTaskByClient'] )->name( 'task.search' );

    Route::resource( 'task', TaskController::class );

    Route::put( 'task/{task}/complete', [TaskController::class, 'markAsComplete'] )->name( 'markAsComplete' );

    Route::get( 'invoices', [InvoiceController::class, 'index'] )->name( 'invoice.index' );
    Route::get( 'invoice/create', [InvoiceController::class, 'create'] )->name( 'invoice.create' );
    Route::get( 'invoice/{invoice}/edit', [InvoiceController::class, 'edit'] )->name( 'invoice.edit' );
    Route::post( 'invoice/store', [InvoiceController::class, 'store'] )->name( 'invoice.store' );
    Route::put( 'invoice/{invoice}/update', [InvoiceController::class, 'update'] )->name( 'invoice.update' );
    Route::delete( 'invoice/{invoice}/destroy', [InvoiceController::class, 'destroy'] )->name( 'invoice.destroy' );
    Route::delete( 'invoice/{invoice}', [InvoiceController::class, 'show'] )->name( 'invoice.show' );

} );

require __DIR__ . '/auth.php';
