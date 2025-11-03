<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Route::get() definieert een GET-route die data ophaalt zonder wijzigingen (bijv. pagina's bekijken)
Route::get('/', function () {
    return view('welcome');
});

// Shop routes (vereist authenticatie)
// Route::get() voor het ophalen van de shop-indexpagina
Route::middleware('auth')->get('/shop', [ShopController::class, 'index'])->name('shop.index');
// Route::get() voor het ophalen van een individueel product
Route::middleware('auth')->get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');
// Route::get() voor het ophalen van de winkelwagenpagina
Route::middleware('auth')->get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
// Route::post() voor het verzenden van data om een product toe te voegen aan de winkelwagen
Route::middleware('auth')->post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('shop.cart.add');
// Route::post() voor het verzenden van data om een product te verwijderen uit de winkelwagen
Route::middleware('auth')->post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('shop.cart.remove');
// Route::get() voor het tonen van het formulier om een nieuw product aan te maken
Route::middleware('auth')->get('/products/create', [ShopController::class, 'create'])->name('shop.create');
// Route::post() voor het opslaan van een nieuw product
Route::middleware('auth')->post('/products', [ShopController::class, 'store'])->name('shop.store');
// Edit/Update/Delete routes
Route::middleware('auth')->get('/products/{id}/edit', [ShopController::class, 'edit'])->name('shop.edit');
Route::middleware('auth')->put('/products/{id}', [ShopController::class, 'update'])->name('shop.update');
Route::middleware('auth')->delete('/products/{id}', [ShopController::class, 'destroy'])->name('shop.destroy');
// Route::post() voor het verzenden van checkout-data
Route::middleware('auth')->post('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');

// Category routes (vereist authenticatie)
Route::middleware('auth')->resource('categories', CategoryController::class)->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Product Image routes (vereist authenticatie)
Route::middleware('auth')->delete('product-images/{productImage}', [App\Http\Controllers\ProductImageController::class, 'destroy'])->name('product-images.destroy');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
