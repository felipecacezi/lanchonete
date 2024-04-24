<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'item_name',
        'item_code',
        'item_image',
        'item_obs',
        'item_quantity',
        'item_min_quantity',
        'item_max_quantity',
        'item_active'
    ];
}
