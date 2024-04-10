<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_tables_name',
        'restaurant_tables_code',
        'restaurant_tables_active'
    ];
}
