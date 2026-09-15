<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stok Produk - Point Of Sales</title>

    @include('inc.css')
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
</head>

<body>

    <div class="sidebar-wrapper" id="sidebar">
        <a href="{{ route('pimpinan.index') }}" class="sidebar-brand">
            <i class="bi bi-asterisk"></i>
            <span>Pimpinan</span>
        </a>
        <div class="flex-grow-1 overflow-y-auto">
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title"> Menu </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('pimpinan.index') }}" class="sidebar-menu-link">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                            <span>Report</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('pimpinan.stok') }}" class="sidebar-menu-link stok-link">
                            <i class="bi bi-box-seam"></i>
                            <span>Stok Product</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-profile">
            <div class="sidebar-profile-info">
                <div class="sidebar-profile-name">{{ auth()->user()->name ?? 'Pimpinan' }}</div>
                <div class="sidebar-profile-email">{{ auth()->user()->email ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div class="main-wrapper">

        @include('inc.nav')

        <div class="page-header">
            <div class="stok-title-wrapper">
                <h1 class="page-title">
                    <a href="{{ route('pimpinan.stok') }}" class="stok-title-link">Stok Produk</a>
                </h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pimpinan.index') }}" class="text-decoration-none text-muted-green"> Home </a>
                    </li>
                    <li class="breadcrumb-item active text-main"> Stok Produk </li>
                </ol>
            </nav>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="60"> No </th>
                                    <th> Foto </th>
                                    <th> Nama Produk </th>
                                    <th> Kategori </th>
                                    <th> Harga </th>
                                    <th> Stok </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td>
                                            @if ($product->photo)
                                                <img src="{{ asset('storage/' . $product->photo) }}" width="60"
                                                    height="60" style="object-fit: cover;" class="rounded">
                                            @else
                                                <span class="text-muted">
                                                    Tidak ada foto
                                                </span>
                                            @endif
                                        </td>
                                        <td> {{ $product->name }} </td>
                                        <td> {{ $product->category->name ?? '-' }} </td>
                                        <td> Rp {{ number_format($product->price, 0, ',', '.') }} </td>
                                        <td>
                                            @if ($product->stock <= 0)
                                                <span class="badge bg-danger">
                                                    Habis
                                                </span>
                                            @elseif ($product->stock <= 5)
                                                <span class="badge bg-warning text-dark">
                                                    {{ $product->stock }}
                                                </span>
                                            @else
                                                <span class="badge bg-success">
                                                    {{ $product->stock }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center"> Belum ada produk. </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('inc.footer')

    </div>


    @include('inc.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarStok = document.getElementById('sidebar-stok');
            const pageStok = document.getElementById('page-stok');

            if (!sidebarStok || !pageStok) return;
            pageStok.addEventListener('mouseenter', function() {
                sidebarStok.classList.add('linked-hover');
            });
            pageStok.addEventListener('mouseleave', function() {
                sidebarStok.classList.remove('linked-hover');
            });

            sidebarStok.addEventListener('mouseenter', function() {
                pageStok.classList.add('linked-hover');
            });

            sidebarStok.addEventListener('mouseleave', function() {
                pageStok.classList.remove('linked-hover');
            });

        });
    </script>


</body>

</html>
