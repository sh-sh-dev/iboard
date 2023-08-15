<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function() {
    Route::prefix('/')->group(function() {
        Route::get('/', [\App\Http\Controllers\OrderSubmitController::class, 'index'])->name('submit');
        Route::post('/', [\App\Http\Controllers\OrderSubmitController::class, 'store'])->name('submit.form');
    });

    Route::prefix('orders')->name('orders.')->group(function() {
        Route::get('/', [\App\Http\Controllers\OrdersController::class, 'index'])->name('list');

        // I know method of this route should be "DELETE", but this is supposed to be a one-day project.
        Route::get('delete/{order}', [\App\Http\Controllers\OrdersController::class, 'destroy'])->name('delete');
    });
});

require __DIR__.'/auth.php';
