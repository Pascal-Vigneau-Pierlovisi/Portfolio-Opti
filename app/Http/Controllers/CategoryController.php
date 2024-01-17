<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Affiche la liste des catégories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Montre le formulaire pour créer une nouvelle catégorie
    public function create()
    {
        return view('categories.create');
    }

    // Enregistre une nouvelle catégorie en base de données
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // autres règles de validation si nécessaire
        ]);

        $category = Category::create($validatedData);

        return redirect('/categories')->with('success', 'Category created successfully.');
    }

    // Montre le formulaire d'édition pour une catégorie spécifique
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Met à jour une catégorie spécifique
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // autres règles de validation si nécessaire
        ]);

        $category->update($validatedData);

        return redirect('/categories')->with('success', 'Category updated successfully.');
    }

    // Supprime une catégorie spécifique
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted successfully.');
    }
}
