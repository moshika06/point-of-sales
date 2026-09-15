@extends('app')
@section('title')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Edit Role</h1>
            @if ($errors->any())
                <ul style="color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom"><i class="bi bi-people"></i></span>
                        <input class="form-control-custom" type="text" name="name"
                            value="{{ old('name', $role->name) }}">
                    </div>
                </div>
                <button class="btn btn-warning" type="submit">Update</button>
                <a class="btn btn-secondary" href="{{ route('roles.index') }}">Kembali</a>
            </form>
        </div>
    </div>
@endsection
