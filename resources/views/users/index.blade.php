@extends('app')
@section('title', 'Data User')
@section('breadcrumb', 'User')
@section('content')
    <style>
        .stok-link,
        .stok-title-link {
            transition: all 0.2s ease;
        }

        body:has(.stok-link:hover) .stok-title-link {
            color: #0d6efd;
        }

        body:has(.stok-title-link:hover) .stok-link {
            color: #0d6efd;
            background-color: #f0f6ff;
        }

        .stok-link:hover {
            color: #0d6efd;
            background-color: #f0f6ff;
        }

        .stok-title-link:hover {
            color: #0d6efd;
        }

        body:has(.stok-link:hover) .stok-title-link,
        .stok-title-link:hover {
            color: #0d6efd;
        }
    </style>
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
                <a class="btn btn-primary" href="{{ route('users.create') }}">
                    <i class="bi bi-plus-lg"></i>
                    Tambah User
                </a>
            </div>
            <table class="table-custom">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $data)
                        <tr>
                            <td class="table-order-id">{{ $loop->iteration }}</td>
                            <td class="table-name">{{ $data->name }}</td>
                            <td class="table-email">{{ $data->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('users.edit', $data->id) }}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('users.destroy', $data->id) }}" method="POST"
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
