@extends('app')
@section('title', 'Data Category')
@section('breadcrumb', 'Category')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                    @endif
                </div>
                <a class="btn btn-primary" href="{{ route('categories.create') }}">
                    <i class="bi bi-plus-lg"></i>Tambah Category</a>
            </div>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="table-order-id">{{ $loop->iteration }}</td>
                            <td class="table-name">{{ $category->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
