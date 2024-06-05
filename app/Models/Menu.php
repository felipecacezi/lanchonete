<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'virtual_menu_title',
        'virtual_menu_active'
    ];

    public function productsMenus()
    {
        return $this->hasMany(MenuProduct::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
