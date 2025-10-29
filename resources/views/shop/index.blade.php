<x-layouts.app :title="'Shop'">
    <style>
        .shop-container { width: 100%; padding: 0; display: flex; gap: 2rem; align-items: flex-start; }
        .sidebar { width: 280px; flex-shrink: 0; position: sticky; top: 1.5rem; height: fit-content; padding: 1.5rem 0; }
        .main-content { flex: 1; min-width: 0; padding: 1.5rem; }
        .shop-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem; }
        .shop-title { font-size: 1.875rem; font-weight: 800; color: #111827; }
        .flash { background: #ecfeff; color: #0e7490; border: 1px solid #a5f3fc; padding: 0.75rem 1rem; border-radius: 10px; margin-bottom: 1rem; }
        .create-btn { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; padding: 0.6rem 1rem; border-radius: 10px; font-weight: 700; text-decoration: none; transition: transform 0.15s ease, box-shadow 0.15s ease; display: inline-block; }
        .create-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(34, 197, 94, 0.35); }

        /* Categories sidebar */
        .categories-sidebar { background: white; border-radius: 14px; padding: 1.5rem; box-shadow: 0 4px 14px rgba(17, 24, 39, 0.06); }
        .categories-title { font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 1rem; display: flex; align-items: center; justify-content: space-between; }
        .category-item { display: block; padding: 0.75rem 1rem; margin-bottom: 0.25rem; border-radius: 8px; text-decoration: none; color: #374151; transition: all 0.15s ease; position: relative; }
        .category-item:hover { background: #f3f4f6; color: #111827; }
        .category-item.active { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }
        .category-item.all { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; margin-bottom: 1rem; }
        .category-item.all:hover { background: linear-gradient(135deg, #16a34a, #15803d); }
        .category-count { font-size: 0.875rem; opacity: 0.8; }
        .category-actions { display: flex; gap: 0.25rem; opacity: 0; transition: opacity 0.15s ease; }
        .category-item:hover .category-actions { opacity: 1; }
        .category-action-btn { padding: 0.25rem; border-radius: 4px; border: none; cursor: pointer; font-size: 0.75rem; background: rgba(255,255,255,0.2); color: white; }
        .category-action-btn:hover { background: rgba(255,255,255,0.3); }

        .grid-products { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
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

        /* Modal styles for inline category editing */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: white; margin: 15% auto; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
        .close:hover { color: black; }
    </style>

    <div class="shop-container">
        <div class="main-content">
            @if (session('status'))
                <div class="flash">{{ session('status') }}</div>
            @endif

            <div class="shop-header">
                <h1 class="shop-title">
                    @if(request('category'))
                        {{ \App\Models\Category::find(request('category'))->name ?? 'Producten' }}
                    @else
                        Producten
                    @endif
                </h1>
                <a href="{{ route('shop.create') }}" class="create-btn">Nieuw Product</a>
            </div>

            <div class="grid-products">
            @foreach ($products as $product)
                <div class="card">
                    @if($product->images->count() > 0)
                        <img class="card-img" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" />
                    @else
                        <img class="card-img" src="https://via.placeholder.com/640x360.png?text=Geen+afbeelding" alt="Geen afbeelding" />
                    @endif
                    <div class="card-body">
                        <div class="card-title">{{ $product->name }}</div>
                        <div class="card-price">€ {{ number_format($product->price, 2, ',', '.') }}</div>
                        @if($product->categories->count() > 0)
                            <div style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">
                                Categorieën: {{ $product->categories->pluck('name')->join(', ') }}
                            </div>
                        @endif
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

        <div class="sidebar">
            <div class="categories-sidebar">
                <div class="categories-title">
                    Categorieën
                    <button onclick="openCategoryModal()" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; border: none; padding: 0.25rem 0.5rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem;">+</button>
                </div>

                <a href="{{ route('shop.index') }}" class="category-item all">
                    Alle Producten
                    <span class="category-count">({{ \App\Models\Product::count() }})</span>
                </a>

                @foreach(\App\Models\Category::all() as $category)
                    <div class="category-item {{ request('category') == $category->id ? 'active' : '' }}">
                        <a href="{{ route('shop.index', ['category' => $category->id]) }}" style="display: block; text-decoration: none; color: inherit;">
                            {{ $category->name }}
                            <span class="category-count">({{ $category->products->count() }})</span>
                        </a>
                        <div class="category-actions">
                            <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}')" class="category-action-btn">✏️</button>
                            <button onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')" class="category-action-btn">🗑️</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCategoryModal()">&times;</span>
            <h2 id="modalTitle">Nieuwe Categorie</h2>
            <form id="categoryForm" onsubmit="saveCategory(event)">
                <input type="hidden" id="categoryId" name="categoryId">
                <div style="margin-bottom: 1rem;">
                    <label for="categoryName" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Naam:</label>
                    <input type="text" id="categoryName" name="name" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="categoryDescription" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Beschrijving:</label>
                    <textarea id="categoryDescription" name="description" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 6px; min-height: 80px; resize: vertical;"></textarea>
                </div>
                <div style="text-align: right;">
                    <button type="button" onclick="closeCategoryModal()" style="background: #6b7280; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; margin-right: 0.5rem; cursor: pointer;">Annuleren</button>
                    <button type="submit" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">Opslaan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCategoryModal() {
            document.getElementById('categoryModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Nieuwe Categorie';
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryId').value = '';
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').style.display = 'none';
        }

        function editCategory(id, name, description) {
            document.getElementById('categoryModal').style.display = 'block';
            document.getElementById('modalTitle').textContent = 'Categorie Bewerken';
            document.getElementById('categoryId').value = id;
            document.getElementById('categoryName').value = name;
            document.getElementById('categoryDescription').value = description;
        }

        function deleteCategory(id, name) {
            if (confirm(`Weet je zeker dat je de categorie "${name}" wilt verwijderen?`)) {
                fetch(`/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response ok:', response.ok);
                    return response.text().then(text => {
                        console.log('Response text:', text);
                        try {
                            const data = JSON.parse(text);
                            if (response.ok) {
                                location.reload();
                            } else {
                                if (data.error) {
                                    alert(data.error);
                                } else {
                                    alert('Er is een fout opgetreden bij het verwijderen van de categorie.');
                                }
                            }
                        } catch (e) {
                            console.error('JSON parse error:', e);
                            alert('Er is een fout opgetreden bij het verwijderen van de categorie.');
                        }
                    });
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Er is een fout opgetreden bij het verwijderen van de categorie.');
                });
            }
        }

        function saveCategory(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const categoryId = formData.get('categoryId');
            const isEdit = categoryId !== '';

            const url = isEdit ? `/categories/${categoryId}` : '/categories';
            const method = isEdit ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    return response.json().then(data => {
                        alert('Er is een fout opgetreden: ' + JSON.stringify(data.errors));
                    });
                }
            })
            .catch(error => {
                alert('Er is een fout opgetreden bij het opslaan van de categorie.');
            });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('categoryModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</x-layouts.app>


