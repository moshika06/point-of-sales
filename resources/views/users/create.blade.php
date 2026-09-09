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
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom"><i class="bi bi-people"></i></span>
                        <input class="form-control-custom" type="text" name="name" value="{{ old('name') }}"
                            placeholder="your name">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom">@</i></span>
                        <input class="form-control-custom" type="email" name="email" value="{{ old('email') }}"
                            placeholder="example@gmail.com">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        <span class="input-group-text-custom"><i class="bi bi-lock"></i></span>
                        <input class="form-control-custom" type="password" name="password" placeholder="your password">
                    </div>
                </div>
                <button class="btn btn-success" type="submit">
                    Simpan
                </button>
                <a class="btn btn-secondary" href="{{ route('users.index') }}">
                    Kembali
                </a>
            </form>
        </div>
    </div>
@endsection
