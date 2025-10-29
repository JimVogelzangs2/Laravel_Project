<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only(['name', 'description']));

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Categorie succesvol aangemaakt.'], 201);
        }

        return redirect()->route('categories.index')->with('status', 'Categorie succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only(['name', 'description']));

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Categorie succesvol bijgewerkt.'], 200);
        }

        return redirect()->route('categories.index')->with('status', 'Categorie succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Detach all products from this category before deleting
        $category->products()->detach();

        $category->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Categorie verwijderd.'], 200);
        }

        return redirect()->route('categories.index')->with('status', 'Categorie verwijderd.');
    }
}
