@extends('app')

@section('title', 'Data Transaksi')

@section('breadcrumb', 'Transaksi')

@section('content')

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h3>
                    Transaction
                </h3>

                <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                    + Tambah Transaksi
                </a>

            </div>


            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                No. Transaksi
                            </th>

                            <th>
                                Kasir
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Payment Method
                            </th>

                            <th>
                                Payment Status
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th width="220">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($orders as $order)
                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $orders->firstItem() + $loop->index }}
                                </td>


                                {{-- ORDER NUMBER --}}
                                <td>
                                    {{ $order->order_number }}
                                </td>


                                {{-- CASHIER --}}
                                <td>
                                    {{ $order->user->name ?? '-' }}
                                </td>


                                {{-- TOTAL --}}
                                <td>
                                    Rp.
                                    {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>


                                {{-- PAYMENT METHOD --}}
                                <td>

                                    @if ($order->payment_method == 0)
                                        <span class="badge bg-success">
                                            💵 Cash
                                        </span>
                                    @elseif ($order->payment_method == 1)
                                        <span class="badge bg-primary">
                                            📱 QRIS
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Unknown
                                        </span>
                                    @endif

                                </td>


                                {{-- PAYMENT STATUS --}}
                                <td>

                                    @if ($order->payment_status == 0)
                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>
                                    @elseif ($order->payment_status == 1)
                                        <span class="badge bg-success">
                                            Paid
                                        </span>
                                    @elseif ($order->payment_status == 2)
                                        <span class="badge bg-danger">
                                            Failed
                                        </span>
                                    @elseif ($order->payment_status == 3)
                                        <span class="badge bg-secondary">
                                            Canceled
                                        </span>
                                    @else
                                        <span class="badge bg-dark">
                                            Unknown
                                        </span>
                                    @endif

                                </td>
                                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('transactions.show', $order->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                    <a href="{{ route('transactions.print', $order->id) }}" target="_blank"
                                        class="btn btn-sm btn-primary">Print</a>
                                    <form action="{{ route('transactions.destroy', $order->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
