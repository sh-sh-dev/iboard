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

Route::prefix('/')->group(function() {
    Route::get('/', [\App\Http\Controllers\OrderSubmitController::class, 'index'])->name('submit');
    Route::post('/', [\App\Http\Controllers\OrderSubmitController::class, 'store'])->name('submit.form');
});

Route::prefix('orders')->group(function() {
    Route::get('/', [\App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
});
