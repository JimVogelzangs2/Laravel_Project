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

        <form action="{{ route('shop.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
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
                <label for="categories" class="form-label">Categorieën:</label>
                <select id="categories" name="categories[]" class="form-input" multiple>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <small style="color: #6b7280; font-size: 0.875rem;">Houd Ctrl (Windows) of Cmd (Mac) ingedrukt om meerdere categorieën te selecteren.</small>
                @error('categories')
                    <div class="error">{{ $message }}</div>
                @enderror

                @if($product->categories->count() > 0)
                    <div style="margin-top: 1rem;">
                        <label class="form-label">Huidige categorieën:</label>
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            @foreach($product->categories as $category)
                                <span style="background: #e5e7eb; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                    {{ $category->name }}
                                    <form action="{{ route('shop.update', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Weet je zeker dat je deze categorie wilt verwijderen van het product?');">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="categories" value="{{ $product->categories->where('id', '!=', $category->id)->pluck('id')->filter()->implode(',') }}">
                                        <button type="submit" style="background: none; border: none; color: #6b7280; cursor: pointer; padding: 0; font-size: 14px; line-height: 1;">×</button>
                                    </form>
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="form-label">Huidige afbeeldingen:</label>
                @if($product->images->count() > 0)
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1rem;">
                        @foreach($product->images as $image)
                            <div style="position: relative; display: inline-block;">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" style="max-width:150px; height:150px; object-fit: cover; border-radius:8px;" />
                                <form action="{{ route('product-images.destroy', $image->id) }}" method="POST" style="position: absolute; top: 5px; right: 5px;" onsubmit="return confirm('Weet je zeker dat je deze afbeelding wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #ef4444; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 12px;">×</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Geen afbeeldingen geüpload.</p>
                @endif
            </div>

            <div class="form-group">
                <label for="images" class="form-label">Nieuwe afbeeldingen toevoegen (optioneel):</label>
                <input type="file" id="images" name="images[]" class="form-input" accept="image/*" multiple>
                <small style="color: #6b7280; font-size: 0.875rem;">Selecteer meerdere afbeeldingen door Ctrl (Windows) of Cmd (Mac) ingedrukt te houden.</small>
                @error('images')
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



