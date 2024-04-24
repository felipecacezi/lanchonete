<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
