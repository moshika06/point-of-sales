<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)
            ->orderBy('name', 'asc')
            ->get();

        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
            'paid' => 'required|integer|min:0',
        ], [
            'products.required' => 'Produk harus dipilih.',
            'products.min' => 'Minimal ada satu produk.',
            'products.*.id.required' => 'Produk harus dipilih.',
            'products.*.id.exists' => 'Produk tidak ditemukan.',
            'products.*.qty.required' => 'Jumlah produk harus diisi.',
            'products.*.qty.min' => 'Jumlah produk minimal 1.',
            'paid.required' => 'Uang pembayaran harus diisi.',
        ]);

        if (!auth()->check()) {
            return redirect()
                ->route('action-login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }


        DB::beginTransaction();

        try {

            $total = 0;
            $cart = [];

            foreach ($request->products as $item) {
                $product = Product::lockForUpdate()
                    ->findOrFail($item['id']);

                $qty = (int) $item['qty'];

                if ($qty > $product->stock) {

                    throw new \Exception(
                        "Stok {$product->name} hanya tersedia {$product->stock}."
                    );
                }

                $subtotal = $product->price * $qty;

                $total += $subtotal;

                $cart[] = [
                    'product' => $product,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ];
            }

            $paid = (int) $request->paid;

            if ($paid < $total) {

                throw new \Exception(
                    'Uang pembayaran kurang.'
                );
            }

            $change = $paid - $total;

            $orderNumber =
                'TRX-' .
                now()->format('YmdHis') .
                '-' .
                strtoupper(Str::random(5));

            $order = Order::create([
                'user_id' => auth()->id(),

                'order_number' => $orderNumber,

                'total_price' => $total,

                'change' => $change,

                // Berdasarkan migration:
                // 0 = cash
                // 1 = midtrans
                'payment_status' => 0,

                // Berdasarkan migration:
                // 0 = pending
                // 1 = paid
                // 2 = failed
                // 3 = canceled
                'payment_method' => 1,

                'snap_token' => null,
            ]);

            foreach ($cart as $item) {

                OrderDetail::create([
                    'order_id' => $order->id,

                    'product_id' => $item['product']->id,

                    'qty' => $item['qty'],

                    'unit_price' => $item['product']->price,

                    'subtotal' => $item['subtotal'],
                ]);


                $item['product']->decrement(
                    'stock',
                    $item['qty']
                );
            }


            DB::commit();


            return redirect()
                ->route('transactions.show', $order->id)
                ->with(
                    'success',
                    'Transaksi berhasil disimpan.'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function show(Order $transaction)
    {
        $transaction->load([
            'user',
            'details.product'
        ]);

        return view(
            'transactions.show',
            [
                'order' => $transaction
            ]
        );
    }

    public function edit(Order $transaction)
    {
        return redirect()
            ->route(
                'transactions.show',
                $transaction->id
            );
    }
    public function update(
        Request $request,
        Order $transaction
    ) {
        return redirect()
            ->route(
                'transactions.show',
                $transaction->id
            )
            ->with(
                'error',
                'Transaksi tidak dapat diedit.'
            );
    }
    public function destroy(Order $transaction)
    {
        DB::beginTransaction();

        try {

            foreach ($transaction->details as $detail) {

                Product::where(
                    'id',
                    $detail->product_id
                )->increment(
                    'stock',
                    $detail->qty
                );
            }


            $transaction->delete();

            DB::commit();


            return redirect()
                ->route('transactions.index')
                ->with(
                    'success',
                    'Transaksi berhasil dihapus.'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with(
                    'error',
                    'Transaksi gagal dihapus.'
                );
        }
    }
    public function print(Order $transaction)
    {
        $transaction->load([
            'user',
            'details.product'
        ]);

        return view(
            'print.receipt',
            [
                'order' => $transaction
            ]
        );
    }
    public function cashier()
    {
        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        return view('cashier.index', compact('products'));
    }
}
