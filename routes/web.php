<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

// Route::get() definieert een GET-route die data ophaalt zonder wijzigingen (bijv. pagina's bekijken)
Route::get('/', function () {
    return view('welcome');
});

// Shop routes (eenvoudig, breekt niets bestaands)
// Route::get() voor het ophalen van de shop-indexpagina
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
// Route::get() voor het ophalen van een individueel product
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');
// Route::get() voor het ophalen van de winkelwagenpagina
Route::get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
// Route::post() voor het verzenden van data om een product toe te voegen aan de winkelwagen
Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('shop.cart.add');
// Route::post() voor het verzenden van data om een product te verwijderen uit de winkelwagen
Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('shop.cart.remove');
// Route::post() voor het verzenden van checkout-data
Route::post('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
