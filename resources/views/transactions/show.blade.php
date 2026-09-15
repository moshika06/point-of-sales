<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 30px;
        }

        .receipt {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
        }

        h1 {
            margin-top: 0;
        }

        .info {
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            border-top: 2px solid #222;
            margin-top: 15px;
            padding-top: 15px;
        }

        .change {
            font-size: 18px;
            color: #16a34a;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 13px;
            border: none;
            border-radius: 7px;
            color: white;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-blue {
            background: #2563eb;
        }

        .btn-green {
            background: #16a34a;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h1>Detail Transaksi</h1>
        <div class="info">
            <div class="row">
                <span>Order</span>
                <strong>{{ $order->order_number }}</strong>
            </div>
            <div class="row">
                <span>Cashier</span>
                <strong>{{ $order->user->name ?? '-' }}</strong>
            </div>
            <div class="row">
                <span>Tanggal</span>
                <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong>
            </div>
        </div>
        @php
            $totalQty = 0;
        @endphp
        @foreach ($order->details as $detail)
            @php
                $totalQty += $detail->qty;
            @endphp
            <div class="item">
                <div>
                    <strong>{{ $detail->product->name }}</strong>
                    <br>
                    <small>
                        {{ $detail->qty }}
                        x
                        Rp {{ number_format($detail->unit_price, 0, ',', '.') }}
                    </small>
                </div>
                <strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong>
            </div>
        @endforeach
        <div class="row">
            <span>Total Qty</span>
            <strong>{{ $totalQty }}</strong>
        </div>
        <div class="row total">
            <span>Total</span>
            <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>

        <div class="row">
            <span>Kembalian</span>
            <span class="change">Rp {{ number_format($order->change, 0, ',', '.') }}</span>
        </div>
        <div class="buttons">
            <a href="{{ route('cashier.index') }}" class="btn btn-blue">Transaksi Baru</a>
            <a href="{{ route('transactions.print', $order->id) }}" target="_blank" class="btn btn-blue">🖨 Print
                Struk</a>
        </div>

    </div>

</body>

</html>
