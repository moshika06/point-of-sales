@extends('app')
@section('title')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Edit User</h1>
            @if ($errors->any())
                <ul style="color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                        required>
                </div>
                @if ($product->photo)
                    <div class="mb-3">
                        <label class="form-label">Photo Sekarang</label>
                        <br>
                        <img src="{{ asset('storage/' . $product->photo) }}" width="120" height="120"
                            style="object-fit: cover;" class="rounded">
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Ganti Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}"
                        min="0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}"
                        min="0" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
