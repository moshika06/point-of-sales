@extends('app')
@section('title')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Tambah User</h1>
            @if ($errors->any())
                <ul style="color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input class="form-control-custom" type="text" name="name" value="{{ old('name') }}"
                        placeholder="category name">
                </div>
                <button class="btn btn-success" type="submit">
                    Simpan
                </button>
                <a class="btn btn-secondary" href="{{ route('categories.index') }}">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
