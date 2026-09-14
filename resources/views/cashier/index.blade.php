<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cashier - POS</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6fa;
            color: #222;
        }

        .navbar {
            height: 65px;
            background: #111827;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .navbar h2 {
            margin: 0;
            font-size: 22px;
        }

        .cashier-name {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 9px 15px;
            border-radius: 7px;
            cursor: pointer;
        }

        .container {
            padding: 25px;
        }

        .page-title {
            margin-bottom: 20px;
        }

        .page-title h1 {
            margin: 0 0 5px;
        }

        .page-title p {
            color: #6b7280;
            margin: 0;
        }

        .cashier-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 25px;
            align-items: start;
        }

        .products-container,
        .cart-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 18px;
        }

        .product-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            background: white;
            transition: .2s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(0, 0, 0, .1);
            border-color: #2563eb;
        }

        .product-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            background: #f3f4f6;
        }

        .product-info {
            padding: 13px;
        }

        .product-name {
            font-weight: bold;
            margin-bottom: 7px;
        }

        .category {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .price {
            font-weight: bold;
            color: #2563eb;
        }

        .stock {
            font-size: 12px;
            margin-top: 7px;
            color: #16a34a;
        }

        .cart-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .cart-title h2 {
            margin: 0;
        }

        .clear-btn {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 7px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .cart-items {
            max-height: 400px;
            overflow-y: auto;
        }

        .empty-cart {
            text-align: center;
            color: #9ca3af;
            padding: 40px 10px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 55px 1fr auto;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .cart-item-image {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 7px;
        }

        .cart-item-name {
            font-weight: bold;
            font-size: 14px;
        }

        .cart-item-price {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 7px;
        }

        .qty-btn {
            width: 24px;
            height: 24px;
            border: none;
            border-radius: 5px;
            background: #e5e7eb;
            cursor: pointer;
        }

        .qty {
            min-width: 20px;
            text-align: center;
        }

        .remove-btn {
            border: none;
            background: transparent;
            color: #dc2626;
            cursor: pointer;
            font-size: 12px;
        }

        .cart-summary {
            border-top: 2px solid #e5e7eb;
            margin-top: 15px;
            padding-top: 15px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-row.total {
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
        }

        .payment-section {
            margin-top: 20px;
        }

        .payment-section label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .payment-input {
            width: 100%;
            padding: 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 18px;
            outline: none;
        }

        .payment-input:focus {
            border-color: #2563eb;
        }

        .change-box {
            margin-top: 12px;
            padding: 13px;
            border-radius: 8px;
            background: #eff6ff;
            display: flex;
            justify-content: space-between;
        }

        .change-value {
            font-weight: bold;
            color: #2563eb;
        }

        .payment-btn {
            width: 100%;
            margin-top: 15px;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #16a34a;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .payment-btn:hover {
            background: #15803d;
        }

        .payment-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .alert {
            padding: 13px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        @media (max-width: 1000px) {
            .cashier-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 12px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <h2>🛒 POS Cashier</h2>

        <div class="cashier-name">
            <span>
                {{ auth()->user()->name ?? 'Cashier' }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">

        <div class="page-title">
            <h1>Product</h1>
            <p>Klik produk untuk menambahkannya ke cart.</p>
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

        <div class="cashier-layout">

            <!-- PRODUCTS -->
            <div class="products-container">

                <div class="products-grid">

                    @forelse($products as $product)
                        <div class="product-card" onclick="addToCart({{ $product->id }})"
                            data-id="{{ $product->id }}">

                            @if ($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" class="product-image"
                                    alt="{{ $product->name }}">
                            @else
                                <div class="product-image"
                                    style="
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:40px;
                                ">
                                    📦
                                </div>
                            @endif

                            <div class="product-info">

                                <div class="product-name">
                                    {{ $product->name }}
                                </div>

                                <div class="category">
                                    Category ID:
                                    {{ $product->category_id }}
                                </div>

                                <div class="price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                                <div class="stock">
                                    Stock: {{ $product->stock }}
                                </div>

                            </div>

                        </div>

                    @empty

                        <p>Tidak ada produk tersedia.</p>
                    @endforelse

                </div>

            </div>


            <!-- CART -->
            <div class="cart-container">

                <div class="cart-title">

                    <h2>Cart</h2>

                    <button type="button" class="clear-btn" onclick="clearCart()">
                        Clear
                    </button>

                </div>

                <div id="cartItems" class="cart-items"></div>

                <div class="cart-summary">

                    <div class="summary-row">
                        <span>Total Qty</span>
                        <strong id="totalQty">0</strong>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="totalPrice">
                            Rp 0
                        </span>
                    </div>

                    <div class="payment-section">

                        <label for="paid">
                            Uang Bayar
                        </label>

                        <input type="number" id="paid" class="payment-input"
                            placeholder="Masukkan uang pembayaran" min="0" oninput="calculateChange()">

                        <div class="change-box">

                            <span>
                                Kembalian
                            </span>

                            <span class="change-value" id="change">
                                Rp 0
                            </span>

                        </div>

                        <form id="paymentForm" action="{{ route('cashier.payment') }}" method="POST">

                            @csrf

                            <div id="productsInput"></div>

                            <input type="hidden" name="paid" id="paidInput">

                            <button type="button" class="payment-btn" id="paymentButton" onclick="payment()" disabled>
                                Payment
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        /*
        |--------------------------------------------------------------------------
        | Product data dari Laravel
        |--------------------------------------------------------------------------
        */

        const products = @json($products);


        /*
        |--------------------------------------------------------------------------
        | Cart
        |--------------------------------------------------------------------------
        */

        let cart = [];


        /*
        |--------------------------------------------------------------------------
        | Format Rupiah
        |--------------------------------------------------------------------------
        */

        function rupiah(number) {

            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(number);

        }


        /*
        |--------------------------------------------------------------------------
        | Tambah product ke cart
        |--------------------------------------------------------------------------
        */

        function addToCart(productId) {

            const product = products.find(
                item => item.id === productId
            );

            if (!product) {
                return;
            }

            const existing = cart.find(
                item => item.id === productId
            );

            if (existing) {

                if (existing.qty >= product.stock) {

                    alert(
                        `Stock ${product.name} hanya ${product.stock}`
                    );

                    return;
                }

                existing.qty++;

            } else {

                cart.push({
                    id: product.id,
                    name: product.name,
                    price: Number(product.price),
                    stock: Number(product.stock),
                    photo: product.photo,
                    qty: 1
                });

            }

            renderCart();

        }


        /*
        |--------------------------------------------------------------------------
        | Render cart
        |--------------------------------------------------------------------------
        */

        function renderCart() {

            const cartContainer =
                document.getElementById('cartItems');

            const totalQtyElement =
                document.getElementById('totalQty');

            const totalPriceElement =
                document.getElementById('totalPrice');

            if (cart.length === 0) {

                cartContainer.innerHTML = `
                <div class="empty-cart">
                    Cart masih kosong.
                    <br>
                    Klik product untuk menambahkannya.
                </div>
            `;

                totalQtyElement.innerText = '0';

                totalPriceElement.innerText =
                    rupiah(0);

                calculateChange();

                return;
            }


            let totalQty = 0;
            let totalPrice = 0;


            cartContainer.innerHTML = cart.map(item => {

                const subtotal =
                    item.price * item.qty;

                totalQty += item.qty;
                totalPrice += subtotal;


                let image = item.photo ?
                    `/storage/${item.photo}` :
                    '';


                return `
                <div class="cart-item">

                    ${
                        image
                        ?
                        `<img
                                src="${image}"
                                class="cart-item-image"
                            >`
                        :
                        `<div
                                class="cart-item-image"
                                style="
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    background:#f3f4f6;
                                "
                            >
                                📦
                            </div>`
                    }

                    <div>

                        <div class="cart-item-name">
                            ${item.name}
                        </div>

                        <div class="cart-item-price">
                            ${rupiah(item.price)}
                        </div>

                        <div class="qty-control">

                            <button
                                type="button"
                                class="qty-btn"
                                onclick="decreaseQty(${item.id})"
                            >
                                -
                            </button>

                            <span class="qty">
                                ${item.qty}
                            </span>

                            <button
                                type="button"
                                class="qty-btn"
                                onclick="increaseQty(${item.id})"
                            >
                                +
                            </button>

                            <button
                                type="button"
                                class="remove-btn"
                                onclick="removeFromCart(${item.id})"
                            >
                                Hapus
                            </button>

                        </div>

                    </div>

                    <strong>
                        ${rupiah(subtotal)}
                    </strong>

                </div>
            `;

            }).join('');


            totalQtyElement.innerText =
                totalQty;

            totalPriceElement.innerText =
                rupiah(totalPrice);


            calculateChange();

        }


        /*
        |--------------------------------------------------------------------------
        | Tambah qty
        |--------------------------------------------------------------------------
        */

        function increaseQty(productId) {

            const item = cart.find(
                item => item.id === productId
            );

            if (!item) {
                return;
            }

            if (item.qty >= item.stock) {

                alert(
                    `Stock ${item.name} hanya ${item.stock}`
                );

                return;
            }

            item.qty++;

            renderCart();

        }


        /*
        |--------------------------------------------------------------------------
        | Kurangi qty
        |--------------------------------------------------------------------------
        */

        function decreaseQty(productId) {

            const item = cart.find(
                item => item.id === productId
            );

            if (!item) {
                return;
            }

            item.qty--;

            if (item.qty <= 0) {

                cart = cart.filter(
                    item => item.id !== productId
                );

            }

            renderCart();

        }


        /*
        |--------------------------------------------------------------------------
        | Remove product
        |--------------------------------------------------------------------------
        */

        function removeFromCart(productId) {

            cart = cart.filter(
                item => item.id !== productId
            );

            renderCart();

        }


        /*
        |--------------------------------------------------------------------------
        | Clear cart
        |--------------------------------------------------------------------------
        */

        function clearCart() {

            if (cart.length === 0) {
                return;
            }

            if (!confirm('Kosongkan semua cart?')) {
                return;
            }

            cart = [];

            document.getElementById('paid').value = '';

            renderCart();

        }


        /*
        |--------------------------------------------------------------------------
        | Hitung total
        |--------------------------------------------------------------------------
        */

        function getTotal() {

            return cart.reduce(
                (total, item) => {

                    return total +
                        (item.price * item.qty);

                },
                0
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Hitung kembalian
        |--------------------------------------------------------------------------
        */

        function calculateChange() {

            const total =
                getTotal();

            const paid =
                Number(
                    document.getElementById('paid').value
                ) || 0;

            const change =
                paid - total;


            document.getElementById('change').innerText =
                rupiah(
                    change > 0 ? change : 0
                );


            const button =
                document.getElementById('paymentButton');


            button.disabled =
                cart.length === 0 ||
                paid < total;

        }


        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */

        function payment() {

            if (cart.length === 0) {

                alert(
                    'Cart masih kosong.'
                );

                return;
            }


            const total =
                getTotal();


            const paid =
                Number(
                    document.getElementById('paid').value
                ) || 0;


            if (paid < total) {

                alert(
                    'Uang pembayaran masih kurang.'
                );

                return;
            }


            const productsInput =
                document.getElementById('productsInput');


            productsInput.innerHTML = '';


            cart.forEach((item, index) => {

                productsInput.innerHTML += `
                <input
                    type="hidden"
                    name="products[${index}][id]"
                    value="${item.id}"
                >

                <input
                    type="hidden"
                    name="products[${index}][qty]"
                    value="${item.qty}"
                >
            `;

            });


            document.getElementById('paidInput').value =
                paid;


            document.getElementById('paymentForm').submit();

        }


        /*
        |--------------------------------------------------------------------------
        | Initial render
        |--------------------------------------------------------------------------
        */

        renderCart();
    </script>

</body>

</html>
