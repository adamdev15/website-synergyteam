<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'transaction_id', 'payment_type', 'transaction_status',
        'fraud_status', 'bank', 'va_number', 'gross_amount', 'response'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
