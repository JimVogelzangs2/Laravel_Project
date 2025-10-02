<x-layouts.app title="Product Bewerken">
    <style>
        .form-container { max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
        .form-input, .form-textarea { width: 100%; padding: 0.75rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s ease; }
        .form-input:focus, .form-textarea:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .form-textarea { resize: vertical; min-height: 100px; }
        .error { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; }
        .btn-group { display: flex; gap: 1rem; justify-content: center; margin-top: 2rem; }
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none; }
        .btn.primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn.primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4); }
        .btn.secondary { background: #6b7280; color: white; }
        .btn.secondary:hover { background: #4b5563; }
    </style>

    <div class="form-container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Product Bewerken</h1>

        <form action="{{ route('shop.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">Productnaam:</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Prijs (€):</label>
                <input type="number" id="price" name="price" class="form-input" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Beschrijving:</label>
                <textarea id="description" name="description" class="form-textarea" required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Huidige afbeelding:</label>
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" style="max-width:200px; height:auto; border-radius:8px; display:block; margin-bottom:8px;" />
                @else
                    <p>Geen afbeelding geüpload.</p>
                @endif
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Nieuwe afbeelding (optioneel):</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn primary">Opslaan</button>
                <a href="{{ route('shop.index') }}" class="btn secondary">Annuleren</a>
            </div>
        </form>
    </div>
</x-layouts.app>



