<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
   protected $fillable = [
        'order_source',
        'fulfilment_type',
        'customer_name',
        'customer_phone',
        'sub_total',
        'delivery_fee',
        'total_amount',
        'order_status',
        'payment_status',
    ];

    protected $casts = [
        'sub_total' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];


    /* =====================
       RELATIONSHIPS
    ======================*/

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /* =====================
       BUSINESS HELPERS
    ======================*/

    public function isDelivery(): bool
    {
        return $this->fulfilment_type === 'DELIVERY';
    }

    public function isCollection(): bool
    {
        return $this->fulfilment_type === 'COLLECTION';
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'PAID';
    }
}
