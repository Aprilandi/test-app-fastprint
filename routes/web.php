<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/produk/data', [ProductController::class, 'getData'])->name('produk.data');
// Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::resource('/produk', ProductController::class);
Route::resource('/kategori', CategoryController::class);
