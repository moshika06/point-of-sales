@extends('app')
@section('title')
@section('breadcrumb', 'Dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Tambah Role</h1>
            @if ($errors->any())
                <ul style="color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="transactionTable">
                                <thead>
                                    <tr>
                                        <th>
                                            Produk
                                        </th>
                                        <th width="130">
                                            Qty
                                        </th>
                                        <th width="180">
                                            Harga
                                        </th>
                                        <th width="180">
                                            Subtotal
                                        </th>
                                        <th width="70">
                                            #
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="product-row">
                                        <td>
                                            <select name="products[0][id]" class="form-control product-select" required>
                                                <option value="">
                                                    -- Pilih Produk --
                                                </option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                                                        data-stock="{{ $product->stock }}">
                                                        {{ $product->name }}
                                                        -
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        (stok: {{ $product->stock }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="products[0][qty]" class="form-control qty"
                                                value="1" min="1" required>
                                        </td>
                                        <td class="price text-end">
                                            Rp 0
                                        </td>
                                        <td class="subtotal text-end">
                                            Rp 0
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                                X
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" id="addProduct" class="btn btn-secondary mb-4">
                            + Tambah Produk
                        </button>
                        <hr>
                        <div class="row">
                            <div class="col-md-5 ms-auto">
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>
                                        TOTAL
                                    </strong>
                                    <strong id="total">
                                        Rp 0
                                    </strong>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">
                                        Uang Dibayar
                                    </label>
                                    <input type="number" name="paid" id="paid" class="form-control" min="0"
                                        required>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>
                                        KEMBALIAN
                                    </strong>
                                    <strong id="change">
                                        Rp 0
                                    </strong>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    Simpan Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                let index = 1;

                function formatRupiah(number) {
                    return 'Rp ' + Number(number).toLocaleString('id-ID');
                }

                function calculate() {
                    let total = 0;
                    document
                        .querySelectorAll('.product-row')
                        .forEach(function(row) {
                            const select = row.querySelector('.product-select');
                            const qty = row.querySelector('.qty');
                            const option = select.options[select.selectedIndex];
                            if (!option || !option.dataset.price) {
                                row.querySelector('.price').innerText = 'Rp 0';
                                row.querySelector('.subtotal').innerText = 'Rp 0';
                                return;
                            }
                            const price = Number(option.dataset.price);
                            const stock = Number(option.dataset.stock);
                            const quantity = Number(qty.value);
                            const subtotal = price * quantity;
                            row.querySelector('.price').innerText = formatRupiah(price);
                            row.querySelector('.subtotal').innerText = formatRupiah(subtotal);
                            total += subtotal;
                        });
                    document.getElementById('total').innerText =
                        formatRupiah(total);
                    const paid = Number(document.getElementById('paid').value) || 0;
                    const change = paid >= total ? paid - total : 0;
                    document.getElementById('change').innerText = formatRupiah(change);
                }
                document
                    .getElementById('addProduct')
                    .addEventListener('click', function() {
                        const tbody =
                            document.querySelector(
                                '#transactionTable tbody'
                            );
                        const row = document.createElement('tr');
                        row.classList.add('product-row');
                        row.innerHTML = `
            <td>
                <select
                    name="products[${index}][id]"
                    class="form-control product-select"
                    required>
                    <option value="">
                        -- Pilih Produk --
                    </option>
                    @foreach ($products as $product)
                        <option
                            value="{{ $product->id }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}">
                            {{ $product->name }}
                            -
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            (stok: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input
                    type="number"
                    name="products[${index}][qty]"
                    class="form-control qty"
                    value="1"
                    min="1"
                    required>
            </td>
            <td class="price text-end">
                Rp 0
            </td>
            <td class="subtotal text-end">
                Rp 0
            </td>
            <td>
                <button
                    type="button"
                    class="btn btn-danger btn-sm remove-row">
                    X
                </button>
            </td>
        `;
                        tbody.appendChild(row);
                        index++;
                    });
                document.addEventListener(
                    'change',
                    function(e) {
                        if (
                            e.target.classList.contains('product-select') ||
                            e.target.classList.contains('qty')
                        ) {
                            calculate();
                        }
                    }
                );
                document.addEventListener(
                    'input',
                    function(e) {
                        if (
                            e.target.id === 'paid' ||
                            e.target.classList.contains('qty')
                        ) {
                            calculate();
                        }
                    }
                );
                document.addEventListener(
                    'click',
                    function(e) {
                        if (
                            e.target.classList.contains('remove-row')
                        ) {
                            const rows =
                                document.querySelectorAll(
                                    '.product-row'
                                );
                            if (rows.length > 1) {
                                e.target
                                    .closest('tr')
                                    .remove();
                                calculate();
                            }
                        }
                    }
                );
            </script>
        </div>
    </div>
@endsection
