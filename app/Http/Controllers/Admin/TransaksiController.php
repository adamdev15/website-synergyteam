<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;


class TransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'payment'])
            ->latest()
            ->get();

        return view('admin.transaksi.data-transaksi', compact('orders'));
    }
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return response()->json(['message' => 'Transaksi dihapus']);
    }

    public function updateStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return response()->json(['message' => 'Status transaksi diperbarui']);
    }

    public function invoice($order_code)
    {
        $order = Order::with(['user', 'items.product'])
            ->where('order_code', $order_code)
            ->firstOrFail();

        $pdf = Pdf::loadView('admin.transaksi.invoice-pdf', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Invoice-' . $order->order_code . '.pdf');
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'data-transaksi.xlsx');
    }
}
