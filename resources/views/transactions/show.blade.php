@extends('app')
@section('title')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Detail Transaksi</h3>
                <div>
                    <a href="{{ route('transactions.print', $order->id) }}" target="_blank" class="btn btn-primary">
                        🖨 Cetak Struk
                    </a>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary"> Kembali</a>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5> {{ $order->order_number }}</h5>
                            <p class="mb-1">
                                <strong>Kasir:</strong>
                                {{ $order->user->name ?? '-' }}
                            </p>
                            <p class="mb-1">
                                <strong>Tanggal:</strong>
                                {{ $order->created_at->format('d-m-Y H:i') }}
                            </p>
                            <p class="mb-0">
                                <strong>Status:</strong>
                                @if ($order->payment_method == 1)
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning"> Pending</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->product->name ?? '-' }}</td>
                                        <td>
                                            Rp {{ number_format($detail->unit_price, 0, ',', '.') }}
                                        </td>
                                        <td> {{ $detail->qty }}</td>
                                        <td>
                                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-end">Kembalian</th>
                                    <th>
                                        Rp {{ number_format($order->change, 0, ',', '.') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
