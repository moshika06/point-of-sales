<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Point Of Sales')</title>

    <!-- SEO Optimization -->
    <meta name="description" content="@yield('description', 'Point Of Sales System')">
    <meta name="author" content="Point Of Sales">

    @include('inc.css')
    <style>
        .report-link,
        .report-title {
            transition: all 0.2s ease;
        }

        body:has(.report-link:hover) .report-title {
            color: #0d6efd;
        }

        body:has(.report-title:hover) .report-link {
            color: #0d6efd;
            background-color: #f0f6ff;
        }

        .report-link:hover {
            color: #0d6efd;
            background-color: #f0f6ff;
        }

        .report-title:hover {
            color: #0d6efd;
        }

        body:has(.report-link:hover) .report-title,
        .report-title:hover {
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
                        <a href="{{ route('pimpinan.index') }}" class="sidebar-menu-link report-link"
                            id="sidebar-report">
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
                <div class="sidebar-profile-name">
                    {{ auth()->user()->name ?? 'Pimpinan' }}
                </div>
                <div class="sidebar-profile-email">
                    {{ auth()->user()->email ?? '-' }}
                </div>
            </div>
        </div>
    </div>
    <div class="main-wrapper">
        @include('inc.nav')

        <div class="page-header">
            <div>
                <h1 class="page-title report-title" id="page-report">
                    @yield('title', 'Report')
                </h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/admin/dashboard') }}" class="text-decoration-none text-muted-green">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-main" aria-current="page">
                        @yield('breadcrumb', 'Dashboard')
                    </li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Laporan Transaksi</h3>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('pimpinan.index') }}">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted"> Total Transaksi</h6>
                            <h3>{{ $totalTransaction }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted">Total Pendapatan</h6>
                            <h3>Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1"> Detail Laporan</h5>
                            <small class="text-muted">
                                Periode:
                                {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}
                                sampai
                                {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}
                            </small>
                        </div>
                        <button type="button" onclick="window.print()" class="btn btn-secondary">🖨 Print
                            Laporan</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="60"> No </th>
                                    <th> No. Transaksi </th>
                                    <th> Kasir </th>
                                    <th> Total</th>
                                    <th> Tanggal </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $order->order_number }} </td>
                                        <td> {{ $order->user->name ?? '-' }} </td>
                                        <td> Rp. {{ number_format($order->total_price, 0, ',', '.') }} </td>
                                        <td> {{ $order->created_at->format('d-m-Y H:i') }} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Tidak ada transaksi
                                            pada periode tersebut.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end"> TOTAL PENDAPATAN </th>
                                    <th> Rp. {{ number_format($totalIncome, 0, ',', '.') }} </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                .container,
                .container * {
                    visibility: visible;
                }

                .container {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                form,
                button {
                    display: none !important;
                }
            }
        </style>

        @include('inc.footer')

    </div>

    @include('inc.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarReport = document.getElementById('sidebar-report');
            const pageReport = document.getElementById('page-report');

            if (!sidebarReport || !pageReport) return;

            pageReport.addEventListener('mouseenter', function() {
                sidebarReport.classList.add('linked-hover');
            });

            pageReport.addEventListener('mouseleave', function() {
                sidebarReport.classList.remove('linked-hover');
            });

            sidebarReport.addEventListener('mouseenter', function() {
                pageReport.classList.add('linked-hover');
            });

            sidebarReport.addEventListener('mouseleave', function() {
                pageReport.classList.remove('linked-hover');
            });
        });
    </script>
</body>

</html>
