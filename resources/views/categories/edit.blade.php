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
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control-custom" type="text" name="name"
                        value="{{ old('name', $category->name) }}">
                </div>
                <button class="btn btn-warning" type="submit">
                    Update
                </button>
                <a class="btn btn-secondary" href="{{ route('users.index') }}">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
