@extends('app')
@section('title', 'Data Role')
@section('breadcrumb', 'Role')
@section('content')

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3>
                Laporan Transaksi
            </h3>

        </div>


        {{-- FILTER TANGGAL --}}

        <div class="card mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('reports.index') }}">

                    <div class="row align-items-end">

                        <div class="col-md-4">

                            <label class="form-label">
                                Tanggal Mulai
                            </label>

                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}"
                                required>

                        </div>


                        <div class="col-md-4">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" required>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan Laporan
                            </button>
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
                        <h3>
                            {{ $totalTransaction }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-muted">Total Pendapatan</h6>
                        <h3> Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
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
                    <button type="button" onclick="window.print()" class="btn btn-secondary">
                        🖨 Print Laporan
                    </button>
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

@endsection
