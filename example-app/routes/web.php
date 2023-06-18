<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/products', [ProductsController::class, 'index']);

Route::controller(ProductsController::class)->group(function () {
    Route::get('/products/create', 'insert');
    Route::post('/products/delete/{id}', 'delete');
    Route::get('/products/update/{id}', 'update'); 
    Route::get('/products/{id}', 'detail');
    Route::get('/products', 'index');
});