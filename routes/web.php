<?php

use App\Http\Controllers\ClientController;
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

} );

require __DIR__ . '/auth.php';
