@extends('app')
@section('title', 'Tambah Product')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Tambah Product</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category_id" class="form-label">
                        Category
                    </label>
                    <div class="input-group-custom">
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Category --</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Name
                    </label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom">
                            <i class="bi bi-people"></i>
                        </span>
                        <input type="text" name="name" id="name"
                            class="form-control-custom @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Product name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">
                        Foto
                    </label>
                    <input type="file" name="photo" id="photo"
                        class="form-control @error('photo') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted d-block mt-1">
                        JPG, JPEG, PNG, WEBP. Maksimal 2MB.
                    </small>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">
                        Price
                    </label>

                    <input type="number" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror" value="{{ old('price', 0) }}"
                        min="0" required placeholder="25000">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">
                        Stock
                    </label>
                    <input type="number" name="stock" id="stock"
                        class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}"
                        min="0" required placeholder="0">
                </div>
                <button class="btn btn-success" type="submit">
                    Simpan
                </button>
                <a class="btn btn-secondary" href="{{ route('products.index') }}">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
