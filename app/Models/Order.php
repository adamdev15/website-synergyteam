<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_code', 'total_amount', 'discount_amount', 'final_amount',
        'status', 'payment_status', 'payment_method', 'promo_id', 'note'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}


