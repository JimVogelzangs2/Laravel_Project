<x-layouts.app :title="'Shop'">
    <h1>Producten</h1>
    <div class="grid">
        @foreach ($products as $product)
            <div class="card">
                <h2>{{ $product['name'] }}</h2>
                <p class="price">€ {{ number_format($product['price'], 2, ',', '.') }}</p>
                <p>
                    <a class="btn" href="{{ route('shop.show', $product['id']) }}">Bekijken</a>
                </p>
            </div>
        @endforeach
    </div>
</x-layouts.app>


