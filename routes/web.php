<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});


Route::resource('products', ProductController::class);
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');


