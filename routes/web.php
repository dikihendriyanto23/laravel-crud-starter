<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProductController::class, 'index']);
Route::post('/product-insert', [ProductController::class, 'store']);
Route::get('/product-get', [ProductController::class, 'getProduct']);
Route::post('/product-update', [ProductController::class, 'updateProduct']);
Route::post('/product-delete', [ProductController::class, 'deleteProduct']);
