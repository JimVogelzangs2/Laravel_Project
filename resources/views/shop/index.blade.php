<x-layouts.app :title="'Shop'">
    <style>
        .shop-container { max-width: 1100px; margin: 0 auto; padding: 1.5rem; }
        .shop-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem; }
        .shop-title { font-size: 1.875rem; font-weight: 800; color: #111827; }
        .flash { background: #ecfeff; color: #0e7490; border: 1px solid #a5f3fc; padding: 0.75rem 1rem; border-radius: 10px; margin-bottom: 1rem; }
        .create-btn { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; padding: 0.6rem 1rem; border-radius: 10px; font-weight: 700; text-decoration: none; transition: transform 0.15s ease, box-shadow 0.15s ease; display: inline-block; }
        .create-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(34, 197, 94, 0.35); }
        .grid-products { display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1rem; }
        @media (min-width: 640px) { .grid-products { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (min-width: 1024px) { .grid-products { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        .card { background: white; border-radius: 14px; overflow: hidden; border: 1px solid #e5e7eb; display: flex; flex-direction: column; height: 100%; box-shadow: 0 4px 14px rgba(17, 24, 39, 0.06); transition: transform .15s ease, box-shadow .15s ease; }
        .card:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(17, 24, 39, 0.10); }
        .card-img { width: 100%; height: 190px; object-fit: cover; display: block; background: #f3f4f6; }
        .card-body { padding: 0.9rem 1rem 1rem; display: flex; flex-direction: column; gap: 0.35rem; flex: 1; }
        .card-title { font-size: 1.125rem; font-weight: 800; color: #111827; }
        .card-price { color: #065f46; font-weight: 800; margin-top: 0.25rem; }
        .card-actions { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.5rem; margin-top: 0.5rem; }
        .btn { display: inline-block; text-align: center; padding: 0.55rem 0.75rem; border-radius: 10px; font-weight: 700; text-decoration: none; border: none; cursor: pointer; transition: background .15s ease, box-shadow .15s ease; }
        .btn-view { background: #2563eb; color: white; }
        .btn-view:hover { background: #1d4ed8; }
        .btn-edit { background: #6b7280; color: white; }
        .btn-edit:hover { background: #4b5563; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-delete:hover { background: #dc2626; }
    </style>

    <div class="shop-container">
        @if (session('status'))
            <div class="flash">{{ session('status') }}</div>
        @endif

        <div class="shop-header">
            <h1 class="shop-title">Producten</h1>
            <a href="{{ route('shop.create') }}" class="create-btn">Nieuw Product</a>
        </div>

        <div class="grid-products">
            @foreach ($products as $product)
                <div class="card">
                    @if($product->image_path)
                        <img class="card-img" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" />
                    @else
                        <img class="card-img" src="https://via.placeholder.com/640x360.png?text=Geen+afbeelding" alt="Geen afbeelding" />
                    @endif
                    <div class="card-body">
                        <div class="card-title">{{ $product->name }}</div>
                        <div class="card-price">€ {{ number_format($product->price, 2, ',', '.') }}</div>
                        <div class="card-actions">
                            <a class="btn btn-view" href="{{ route('shop.show', $product->id) }}">Bekijken</a>
                            <a class="btn btn-edit" href="{{ route('shop.edit', $product->id) }}">Bewerken</a>
                            <form action="{{ route('shop.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" style="grid-column: span 2;">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>


