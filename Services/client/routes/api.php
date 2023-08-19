<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Orders\Items\StoreController as OrderItemStore;
use App\Http\Controllers\Orders\IndexController as OrdersIndex;
use App\Http\Controllers\Orders\StoreController as OrdersStore;
use App\Http\Controllers\Clients\IndexController as ClientsIndex;
use App\Http\Controllers\Clients\StoreController as ClientsStore;

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
    Route::get('/', ClientsIndex::class)->name('list');
    Route::post('/', ClientsStore::class)->name('register');
    Route::put('{ulid}')->name('update');
    Route::delete('{ulid}')->name('delete');

    Route::prefix('{ulid}')->group(static function () : void {
        Route::get('orders', OrdersIndex::class)->name('orders:list');
        Route::post('orders', OrdersStore::class)->name('orders:store');
        Route::post('orders/{order}', OrderItemStore::class)->name('orders:add');
    });
});
