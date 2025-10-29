<x-layouts.app title="Categorieën">
    <style>
        .categories-container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .categories-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .category-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 1.5rem; transition: transform 0.3s ease; }
        .category-card:hover { transform: translateY(-2px); }
        .category-name { font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; }
        .category-description { color: #6b7280; margin-bottom: 1rem; }
        .category-stats { font-size: 0.875rem; color: #374151; }
        .btn-group { display: flex; gap: 0.5rem; margin-top: 1rem; }
        .btn { padding: 0.5rem 1rem; border-radius: 6px; font-weight: 500; text-decoration: none; transition: all 0.3s ease; cursor: pointer; border: none; font-size: 0.875rem; }
        .btn.primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn.primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4); }
        .btn.secondary { background: #6b7280; color: white; }
        .btn.secondary:hover { background: #4b5563; }
        .btn.danger { background: #dc2626; color: white; }
        .btn.danger:hover { background: #b91c1c; }
        .create-btn { display: inline-block; margin-bottom: 2rem; }
        .empty-state { text-align: center; padding: 3rem; color: #6b7280; }
    </style>

    <div class="categories-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1 style="color: #1f2937;">Categorieën</h1>
            <a href="{{ route('categories.create') }}" class="btn primary create-btn">Nieuwe Categorie</a>
        </div>

        @if(session('status'))
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                {{ session('status') }}
            </div>
        @endif

        @if($categories->count() > 0)
            <div class="categories-grid">
                @foreach($categories as $category)
                    <div class="category-card">
                        <div class="category-name">{{ $category->name }}</div>
                        @if($category->description)
                            <div class="category-description">{{ $category->description }}</div>
                        @endif
                        <div class="category-stats">{{ $category->products->count() }} producten</div>
                        <div class="btn-group">
                            <a href="{{ route('categories.show', $category) }}" class="btn secondary">Bekijken</a>
                            <a href="{{ route('categories.edit', $category) }}" class="btn primary">Bewerken</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn danger" onclick="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>Geen categorieën gevonden</h2>
                <p>Maak je eerste categorie aan om producten te organiseren.</p>
                <a href="{{ route('categories.create') }}" class="btn primary">Eerste Categorie Aanmaken</a>
            </div>
        @endif
    </div>
</x-layouts.app>