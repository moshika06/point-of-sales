<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('photo')) {

            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('warning', 'Product berhasil diupdate.');
    }
    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->route('products.index')->with('danger', 'Product berhasil dihapus.');
    }
    public function stok()
    {
        $products = Product::with('category')->orderBy('name', 'asc')->get();
        return view('pimpinan.stok', compact('products'));
    }
}
