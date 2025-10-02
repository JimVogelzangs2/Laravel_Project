<x-layouts.app :title="$product->name">
    <a href="{{ route('shop.index') }}" class="btn secondary">Terug</a>
    <h1>{{ $product->name }}</h1>
    @if($product->image_path)
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width:400px; height:auto; border-radius:8px; margin-bottom:12px;" />
    @endif
    <p>{{ $product->description }}</p>
    <p class="price">€ {{ number_format($product->price, 2, ',', '.') }}</p>
    <form method="post" action="{{ route('shop.cart.add', $product->id) }}">
        @csrf
        <label>Aantal
            <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
        </label>
        <button type="submit" class="btn">Toevoegen aan winkelwagen</button>
    </form>
    <p style="margin-top:12px;">
        <a class="btn secondary" href="{{ route('shop.edit', $product->id) }}">Bewerken</a>
    </p>
</x-layouts.app>


