<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCartController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Models\Product;





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $products = Product::all();  
        return view("welcome", ["products" => $products]);
    });
// Cart
    Route::get('/cart/index/{user_id}', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/store', [CartController::class, 'store'])->name('product.store');
    Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/product_cart/add/{product_id}/{user_id}', [ProductCartController::class, 'add'])->name('product_cart.add');

// Product
    Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    
// Order
Route::post('/order/create/{user_id}/{cart_id}/{totalPrice}', [OrderController::class, 'create'])->name('order.create');
Route::get('/order/index', [OrderController::class, 'index'])->name('order.index');


// profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
