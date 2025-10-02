<x-layouts.app :title="$product->name">
    <a href="{{ route('shop.index') }}" class="btn secondary">Terug</a>
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p class="price">€ {{ number_format($product->price, 2, ',', '.') }}</p>
    <form method="post" action="{{ route('shop.cart.add', $product->id) }}">
        @csrf
        <label>Aantal
            <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
        </label>
        <button type="submit" class="btn">Toevoegen aan winkelwagen</button>
    </form>
</x-layouts.app>


