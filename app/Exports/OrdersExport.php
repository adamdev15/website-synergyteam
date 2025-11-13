<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Order::with('user')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Order Code',
            'Customer Name',
            'Customer Email',
            'Total Amount',
            'Final Amount',
            'Status',
            'Payment Status',
            'Payment Method',
            'Created At',
        ];
    }

    public function map($order): array
    {
        return [
            $order->order_code,
            $order->user->name ?? '-',
            $order->user->email ?? '-',
            number_format($order->total_amount, 0, ',', '.'),
            number_format($order->final_amount, 0, ',', '.'),
            strtoupper($order->status),
            strtoupper($order->payment_status),
            strtoupper($order->payment_method),
            $order->created_at->format('d-m-Y H:i'),
        ];
    }
}
