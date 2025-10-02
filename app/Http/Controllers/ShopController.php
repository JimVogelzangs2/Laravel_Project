<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class ShopController extends Controller
{

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
        $products = Product::all();
        $cart = $this->getCart();
        return view('shop.index', compact('products', 'cart'));
    }

    // show() toont een individueel product (abort() stopt uitvoering bij 404-fout)
    public function show(int $id)
    {
        $product = Product::findOrFail($id);
        $cart = $this->getCart();
        return view('shop.show', compact('product', 'cart'));
    }

    // addToCart() voegt product toe aan winkelwagen (Request $request voor input, redirect()->route() voor doorsturen)
    public function addToCart(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
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
        $products = Product::all();
        $cart = $this->getCart();
        return view('shop.cart', compact('products', 'cart'));
    }

    // create() toont het formulier voor het aanmaken van een nieuw product
    public function create()
    {
        return view('shop.create');
    }

    // store() slaat een nieuw product op (Request $request voor input, redirect() voor doorsturen)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['name', 'price', 'description']);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }
        Product::create($data);

        return redirect()->route('shop.index')->with('status', 'Product succesvol aangemaakt.');
    }

    // edit() toont het formulier om een product te bewerken
    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        return view('shop.edit', compact('product'));
    }

    // update() werkt een product bij
    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['name', 'price', 'description']);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }
        $product->update($data);

        return redirect()->route('shop.index')->with('status', 'Product succesvol bijgewerkt.');
    }

    // destroy() verwijdert een product
    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('shop.index')->with('status', 'Product verwijderd.');
    }

    // checkout() verwerkt afrekening (Session::forget() wist sessie-data)
    public function checkout()
    {
        // In een echte shop zou hier betaling/logica komen.
        Session::forget('cart');
        return view('shop.checkout');
    }
}


