<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/products/data', [ProductController::class, 'getData'])->name('products.data');
Route::post('/products/{id}/update', [ProductController::class, 'updateProduct'])->name('products.updateproduct');
Route::resource('product', ProductController::class);
