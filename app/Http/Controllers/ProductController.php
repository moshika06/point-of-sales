<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan semua product
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Form tambah product
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Simpan product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Upload photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    /**
     * Form edit product
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Kalau upload foto baru
        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            // Simpan foto baru
            $validated['photo'] = $request->file('photo')
                ->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('warning', 'Product berhasil diupdate.');
    }

    /**
     * Hapus product
     */
    public function destroy(Product $product)
    {
        // Hapus file foto
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('danger', 'Product berhasil dihapus.');
    }
}
