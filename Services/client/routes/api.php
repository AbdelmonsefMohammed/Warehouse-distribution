<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\IndexController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('service-auth')->prefix('clients')->as('clients:')->group(static function () : void {
    Route::get('/', IndexController::class)->name('list');
    Route::post('/')->name('register');
    Route::put('{ulid}')->name('update');
    Route::delete('{ulid}')->name('delete');

    Route::prefix('{ulid}')->group(static function () : void {
        Route::get('orders')->name('orders:list');
    });
});
