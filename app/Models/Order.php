<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_number', 'total_price', 'change', 'payment_status', 'payment_method', 'snap_token',];
    protected $casts = ['total_price' => 'integer', 'change' => 'integer', 'payment_status' => 'integer', 'payment_method' => 'integer',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getPaymentMethodLabelAttribute()
    {
        return match ((int) $this->payment_method) {
            0 => 'Cash',
            1 => 'QRIS',
            default => 'Unknown',
        };
    }

    public function getPaymentStatusLabelAttribute()
    {
        return match ((int) $this->payment_status) {
            0 => 'Pending',
            1 => 'Paid',
            2 => 'Failed',
            3 => 'Canceled',
            default => 'Unknown',
        };
    }
}
