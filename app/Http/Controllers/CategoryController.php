<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // SELECT
    public function index()
    {
        $categories = Category::latest()->get();

        return view('categories.index', compact('categories'));
    }

    // FORM INSERT
    public function create()
    {
        return view('categories.create');
    }

    // INSERT
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category berhasil ditambahkan');
    }

    // FORM UPDATE
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // UPDATE
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->name = $request->name;
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('warning', 'Category berhasil diubah');
    }

    // DELETE
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('danger', 'Category berhasil dihapus');
    }
}
