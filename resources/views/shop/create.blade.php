<x-layouts.app title="Nieuw Product Aanmaken">
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
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Nieuw Product Aanmaken</h1>

        <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image" class="form-label">Afbeelding (optioneel):</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Productnaam:</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" placeholder="Voer de productnaam in" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Prijs (€):</label>
                <input type="number" id="price" name="price" class="form-input" step="0.01" min="0" value="{{ old('price') }}" placeholder="0.00" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Beschrijving:</label>
                <textarea id="description" name="description" class="form-textarea" placeholder="Beschrijf het product..." required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="categories" class="form-label">Categorieën:</label>
                <select id="categories" name="categories[]" class="form-input" multiple>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <small style="color: #6b7280; font-size: 0.875rem;">Houd Ctrl (Windows) of Cmd (Mac) ingedrukt om meerdere categorieën te selecteren.</small>
                @error('categories')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn primary">Product Aanmaken</button>
                <a href="{{ route('shop.index') }}" class="btn secondary">Annuleren</a>
            </div>
        </form>
    </div>
</x-layouts.app>