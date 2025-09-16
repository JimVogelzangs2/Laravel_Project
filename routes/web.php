<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

Route::get('/', function () {
    return view('welcome');
});

// Shop routes (eenvoudig, breekt niets bestaands)
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('shop.cart.add');
Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('shop.cart.remove');
Route::post('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
