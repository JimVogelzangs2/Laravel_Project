<x-layouts.app :title="'Shop'">
    <h1>Producten</h1>
    <p><a href="{{ route('shop.create') }}" class="btn">Nieuw Product Aanmaken</a></p>
    <div class="grid">
        @foreach ($products as $product)
            <div class="card">
                <h2>{{ $product->name }}</h2>
                <p class="price">€ {{ number_format($product->price, 2, ',', '.') }}</p>
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width:100%; height:auto; border-radius:8px; margin-bottom:8px;" />
                @endif
                <p>
                    <a class="btn" href="{{ route('shop.show', $product->id) }}">Bekijken</a>
                    <a class="btn secondary" href="{{ route('shop.edit', $product->id) }}">Bewerken</a>
                </p>
                <form action="{{ route('shop.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn secondary">Verwijderen</button>
                </form>
                </p>
            </div>
        @endforeach
    </div>
</x-layouts.app>


