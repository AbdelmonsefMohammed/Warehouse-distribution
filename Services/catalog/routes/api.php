<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products\ShowController as ProductsShow;
use App\Http\Controllers\Products\IndexController as ProductsIndex;

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

Route::middleware('service-auth')->prefix('products')->as('products:')->group(static function () : void {
    Route::get('/', ProductsShow::class)->name('index');
    Route::get('{ulid}',ShowController::class)->name('show');
});
