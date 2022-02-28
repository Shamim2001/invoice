<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} );

// backend
Route::prefix( '/' )->middleware( ['auth'] )->group( function () {

    Route::get( 'dashboard', function () {

        $user = User::find( Auth::user()->id );

        return view( 'dashboard' )->with( [
            'user'            => $user,
            'pending_task'    => $user->tasks->where( 'status', 'pending' ),
            'unpaid_invoices' => $user->invoices->where( 'status', 'unpaid' ),
            'paid_invoices'   => $user->invoices->where( 'status', 'paid' ),
        ] );
    } )->name( 'dashboard' );

    // client resource route
    Route::resource( 'client', ClientController::class );

    // task route
    Route::resource( 'task', TaskController::class );
    Route::put( 'task/{task}/complete', [TaskController::class, 'markAsComplete'] )->name( 'markAsComplete' );

    // invoices route
    Route::prefix( 'invoices' )->group( function () {
        Route::get( '/', [InvoiceController::class, 'index'] )->name( 'invoice.index' );
        Route::get( '/create', [InvoiceController::class, 'create'] )->name( 'invoice.create' );
        Route::put( '/{invoice}/update', [InvoiceController::class, 'update'] )->name( 'invoice.update' );
        Route::delete( '/{invoice}/destroy', [InvoiceController::class, 'destroy'] )->name( 'invoice.destroy' );
        Route::get( 'invoice', [InvoiceController::class, 'invoice'] )->name( 'invoice' );
        Route::get( '/email/send/{invoice:invoice_id}', [InvoiceController::class, 'sendEmail'] )->name( 'invoice.sendEmail' );
    } );

    // settings
    Route::get( 'settings', [settingsController::class, 'index'] )->name( 'settings.index' );
    Route::post( 'settings/update', [settingsController::class, 'update'] )->name( 'settings.update' );

} );

require __DIR__ . '/auth.php';
