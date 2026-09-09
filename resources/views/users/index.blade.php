@extends('app')
@section('title', 'Data User')
@section('breadcrumb', 'User')
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
                <a class="btn btn-primary" href="{{ route('users.create') }}">
                    <i class="bi bi-plus-lg"></i>
                    Tambah User
                </a>
            </div>
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
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
