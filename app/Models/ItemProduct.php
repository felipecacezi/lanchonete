<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'product_id',
        'item_product_quantity'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
