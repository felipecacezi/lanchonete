<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'product_id'
    ];

    public function productsMenu()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'id', 'menu_id');
    }
}
