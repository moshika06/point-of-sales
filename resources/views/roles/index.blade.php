@extends('app')
@section('title', 'Data Role')
@section('breadcrumb', 'Role')
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
                <a class="btn btn-primary" href="{{ route('roles.create') }}">
                    <i class="bi bi-plus-lg"></i>Tambah Role</a>
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
                    @foreach ($roles as $data)
                        <tr>
                            <td class="table-order-id">{{ $loop->iteration }}</td>
                            <td class="table-name">{{ $data->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('roles.edit', $data->id) }}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('roles.destroy', $data->id) }}" method="POST"
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
