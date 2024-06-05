<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_client_name',
        'order_discount',
        'order_subtotal',
        'order_total',
        'order_active',
        'order_status'
    ];

    public function orderProducts()
    {
        return $this->belongsToMany(OrderProduct::class);
    }
}
