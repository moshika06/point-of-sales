@extends('app')
@section('title', 'Data Product')
@section('breadcrumb', 'Product')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    @if (session('success'))
                        <div class="alert alert-success mb-0" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <a class="btn btn-primary" href="{{ route('products.create') }}">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Product
                </a>
            </div>
            <table class="table-custom table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Photo</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                @if ($product->photo)
                                    <img src="{{ asset('storage/' . $product->photo) }}" width="70" height="70"
                                        style="object-fit: cover;" class="rounded" alt="{{ $product->name }}">
                                @else
                                    <span class="text-muted">
                                        No Photo
                                    </span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td> Rp {{ number_format($product->price, 0, ',', '.') }} </td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('products.edit', $product->id) }}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-btn-action delete" title="Delete row">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada product.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
