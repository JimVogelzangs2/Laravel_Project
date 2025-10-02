<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    /**
     * Eenvoudige in-memory productlijst.
     */
    private function getProducts(): array
    {
        return [
            1 => ['id' => 1, 'name' => 'USB-C Kabel', 'price' => 9.99, 'description' => 'Stevige 1m USB-C kabel.'],
            2 => ['id' => 2, 'name' => 'Bluetooth Speaker', 'price' => 29.95, 'description' => 'Compacte speaker met helder geluid.'],
            3 => ['id' => 3, 'name' => 'Draadloze Muis', 'price' => 19.5, 'description' => 'Comfortabele muis met 2,4GHz dongle.'],
        ];
    }

    // getCart() haalt de winkelwagen op uit de sessie (Session::get() leest sessie-data)
    private function getCart(): array
    {
        return Session::get('cart', []);
    }

    // saveCart() slaat de winkelwagen op in de sessie (Session::put() schrijft sessie-data)
    private function saveCart(array $cart): void
    {
        Session::put('cart', $cart);
    }

    // index() toont de shop-indexpagina (view() rendert Blade-template met compact() voor data-doorgave)
    public function index()
    {
        $products = $this->getProducts();
        $cart = $this->getCart();
        return view('shop.index', compact('products', 'cart'));
    }

    // show() toont een individueel product (abort() stopt uitvoering bij 404-fout)
    public function show(int $id)
    {
        $products = $this->getProducts();
        if (!isset($products[$id])) {
            abort(404);
        }
        $product = $products[$id];
        $cart = $this->getCart();
        return view('shop.show', compact('product', 'cart'));
    }

    // addToCart() voegt product toe aan winkelwagen (Request $request voor input, redirect()->route() voor doorsturen)
    public function addToCart(Request $request, int $id)
    {
        $products = $this->getProducts();
        if (!isset($products[$id])) {
            abort(404);
        }
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = $this->getCart();
        $cart[$id] = ($cart[$id] ?? 0) + $quantity;
        $this->saveCart($cart);
        return redirect()->route('shop.cart')->with('status', 'Product toegevoegd aan winkelwagen.');
    }

    // removeFromCart() verwijdert product uit winkelwagen (redirect()->route() voor doorsturen)
    public function removeFromCart(int $id)
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }
        return redirect()->route('shop.cart')->with('status', 'Product verwijderd.');
    }

    // cart() toont de winkelwagenpagina
    public function cart()
    {
        $products = $this->getProducts();
        $cart = $this->getCart();
        return view('shop.cart', compact('products', 'cart'));
    }

    // checkout() verwerkt afrekening (Session::forget() wist sessie-data)
    public function checkout()
    {
        // In een echte shop zou hier betaling/logica komen.
        Session::forget('cart');
        return view('shop.checkout');
    }
}


