<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date
            ?? now()->startOfMonth()->format('Y-m-d');

        $endDate = $request->end_date
            ?? now()->format('Y-m-d');

        $orders = Order::with([
            'user',
            'details.product'
        ])
            ->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])
            ->where('payment_method', 1)
            ->latest()
            ->get();

        $totalTransaction = $orders->count();

        $totalIncome = $orders->sum('total_price');

        return view('pimpinan.index', compact(
            'orders',
            'startDate',
            'endDate',
            'totalTransaction',
            'totalIncome'
        ));
    }
}
