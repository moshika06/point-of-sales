<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk - {{ $order->order_number }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            background: #eee;
        }

        .receipt {
            width: 80mm;
            max-width: 80mm;
            margin: 20px auto;
            padding: 5mm;
            background: #fff;
        }

        .header {
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 11px;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .info {
            font-size: 11px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin: 4px 0;
        }

        .info-row span {
            flex-shrink: 0;
        }

        .info-row strong {
            text-align: right;
            word-break: break-word;
        }

        .items {
            font-size: 11px;
        }

        .item {
            margin-bottom: 8px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 3px;
            word-break: break-word;
        }

        .item-detail {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 5px;
        }

        .item-detail span {
            flex: 1;
        }

        .item-detail strong {
            white-space: nowrap;
            text-align: right;
        }

        .summary {
            font-size: 11px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 5px 0;
        }

        .summary-row span:last-child,
        .summary-row strong {
            text-align: right;
            white-space: nowrap;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
        }

        .footer p {
            margin: 3px 0;
        }

        .print-button {
            display: block;
            width: 80mm;
            max-width: 80mm;
            margin: 10px auto 20px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #2563eb;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
        }

        .print-button:hover {
            background: #1d4ed8;
        }

        @media print {

            @page {
                size: 80mm auto;
                margin: 0;
            }

            html,
            body {
                width: 80mm;
                min-width: 80mm;
                max-width: 80mm;

                margin: 0;
                padding: 0;

                background: #fff;
            }

            .receipt {
                width: 80mm;
                max-width: 80mm;

                margin: 0;
                padding: 5mm;

                background: #fff;
            }

            .print-button {
                display: none !important;
            }
        }
    </style>

</head>

<body>
    <div class="receipt">
        <div class="header">
            <h2>STRUK TRANSAKSI</h2>
            <p>Terima kasih atas pembelian Anda</p>
        </div>
        <div class="line"></div>
        <div class="info">
            <div class="info-row">
                <span>Order</span>
                <strong>{{ $order->order_number }}</strong>
            </div>
            <div class="info-row">
                <span>Kasir</span>
                <strong>{{ $order->user->name ?? '-' }}</strong>
            </div>
            <div class="info-row">
                <span>Tanggal</span>
                <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong>
            </div>
            <div class="info-row">
                <span>Pembayaran</span>
                <strong>{{ $order->payment_method_label }}</strong>
            </div>
        </div>
        <div class="line"></div>
        @php
            $totalQty = 0;
        @endphp
        <div class="items">
            @forelse ($order->details as $detail)
                @php
                    $totalQty += $detail->qty;
                @endphp
                <div class="item">
                    <div class="item-name">{{ $detail->product->name ?? 'Produk' }}</div>
                    <div class="item-detail">
                        <span>
                            {{ $detail->qty }}
                            x
                            Rp {{ number_format($detail->unit_price, 0, ',', '.') }}
                        </span>
                        <strong>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</strong>
                    </div>
                </div>
            @empty
                <div class="item">Tidak ada produk.</div>
            @endforelse
        </div>
        <div class="line"></div>
        <div class="summary">
            <div class="summary-row">
                <span>Total Qty</span>
                <strong>{{ $totalQty }}</strong>
            </div>
            <div class="summary-row total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            @if ($order->payment_method == 0)
                <div class="summary-row">
                    <span>Dibayar</span>
                    <strong>Rp {{ number_format($order->total_price + $order->change, 0, ',', '.') }}</strong>
                </div>
                <div class="summary-row">
                    <span>Kembalian</span>
                    <strong>Rp {{ number_format($order->change, 0, ',', '.') }}</strong>
                </div>
            @else
                <div class="summary-row">
                    <span>Pembayaran</span>
                    <strong>QRIS</strong>
                </div>
            @endif
        </div>
        <div class="line"></div>
        <div class="footer">
            <p>Terima kasih</p>
            <p>Silakan datang kembali</p>
        </div>
    </div>

    <button type="button" class="print-button" onclick="window.print()">🖨 Print</button>
</body>

</html>
