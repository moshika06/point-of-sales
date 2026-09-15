<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>
        Struk {{ $order->order_number }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            width: 80mm;
            margin: 0 auto;
            font-size: 12px;
            color: #000;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 3px 0;
            vertical-align: top;
        }

        .product-name {
            font-weight: bold;
        }

        .no-print {
            margin-top: 30px;
            text-align: center;
        }

        @media print {
            body {
                width: 80mm;
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="center">
        <h3 style="margin: 0 0 5px 0;"> POS / KASIR </h3>
        <div> Jl. J. Sudirmar </div>
        <div> Telp. 0858-5456-7694 </div>

    </div>
    <div class="line"></div>
    <table>
        <tr>
            <td> No. Transaksi </td>
            <td class="right"> {{ $order->order_number }} </td>
        </tr>
        <tr>
            <td> Kasir </td>
            <td class="right"> {{ $order->user->name ?? '-' }} </td>
        </tr>
        <tr>
            <td> Tanggal </td>
            <td class="right"> {{ $order->created_at->format('d/m/Y H:i') }} </td>
        </tr>
    </table>
    <div class="line"></div>
    <table>
        @foreach ($order->details as $detail)
            <tr>
                <td colspan="2" class="product-name"> {{ $detail->product->name ?? '-' }} </td>
            </tr>
            <tr>
                <td>
                    {{ $detail->qty }}
                    x
                    Rp. {{ number_format($detail->unit_price, 0, ',', '.') }}
                </td>
                <td class="right"> Rp. {{ number_format($detail->subtotal, 0, ',', '.') }} </td>
            </tr>
        @endforeach
    </table>
    <div class="line"></div>
    <table>
        <tr>
            <td> TOTAL </td>
            <td class="right"> Rp. {{ number_format($order->total_price, 0, ',', '.') }} </td>
        </tr>
        <tr>
            <td> BAYAR </td>
            <td class="right"> Rp. {{ number_format($order->total_price + $order->change, 0, ',', '.') }} </td>
        </tr>
        <tr>
            <td> KEMBALI </td>
            <td class="right"> Rp. {{ number_format($order->change, 0, ',', '.') }} </td>
        </tr>
    </table>
    <div class="line"></div>
    <div class="center">
        <strong>TERIMA KASIH</strong>
        <br>
        Sudah berbelanja.
        <br>
        Barang yang sudah dibeli
        tidak dapat dikembalikan.
    </div>
    <div class="no-print">
        <button onclick="window.print()"> Cetak Struk </button>
    </div>
</body>

</html>
