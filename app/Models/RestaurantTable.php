<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'restaurant_table_name',
        'restaurant_table_code',
        'restaurant_table_active'
    ];
}
