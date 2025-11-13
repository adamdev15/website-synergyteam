<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Card Summary
        $totalRevenue = Order::where('payment_status', 'paid')->sum('final_amount');
        $totalTransaction = Order::count();
        $totalUsers = User::count();
        $totalProducts = Product::count();

        $latestUsers = User::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 'totalTransaction', 'totalUsers', 'totalProducts', 'latestUsers'
        ));
    }

    // API untuk grafik transaksi
    public function stats(Request $request)
    {
        $filter = $request->query('filter', 'month'); 

        if ($filter === '3days') {
            $start = Carbon::now()->subDays(3);
            $format = '%H:00';
        } elseif ($filter === 'year') {
            $start = Carbon::now()->subYear();
            $format = '%M %Y';
        } else { // month
            $start = Carbon::now()->subMonth();
            $format = '%d %M';
        }

        $data = Order::select(
                DB::raw("DATE_FORMAT(created_at, '$format') AS label"),
                DB::raw("SUM(final_amount) AS total")
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', $start)
            ->groupBy('label')
            ->orderBy('label')
            ->get();

        return response()->json([
            'labels' => $data->pluck('label'),
            'values' => $data->pluck('total'),
        ]);
    }
}
