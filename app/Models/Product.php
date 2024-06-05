<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_name',
        'product_code',
        'product_description',
        'product_obs',
        'product_price',
        'product_image',
        'product_active',
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function orderProducts()
    {
        return $this->belongsToMany(OrderProduct::class);
    }

    public function itemsProduct()
    {
        return $this->hasMany(ItemProduct::class);
    }

    public function productMenus()
    {
        return $this->belongsTo(MenuProduct::class);
    }
}
