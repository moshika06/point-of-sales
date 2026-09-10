@extends('app')
@section('title', 'Data Transaksi')
@section('breadcrumb', 'Transaksi')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Transaction</h3>
                <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="60"> No </th>
                        <th> No. Transaksi </th>
                        <th> Kasir </th>
                        <th> Total </th>
                        <th> Tanggal </th>
                        <th width="220"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td> {{ $orders->firstItem() + $loop->index }} </td>
                            <td> {{ $order->order_number }} </td>
                            <td> {{ $order->user->name ?? '-' }} </td>
                            <td> Rp. {{ number_format($order->total_price, 0, ',', '.') }} </td>
                            <td> {{ $order->created_at->format('d-m-Y H:i') }} </td>
                            <td>
                                <a href="{{ route('transactions.show', $order->id) }}" class="btn btn-sm btn-info">
                                    Detail
                                </a>
                                <a href="{{ route('transactions.print', $order->id) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    Print
                                </a>
                                <form action="{{ route('transactions.destroy', $order->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
