<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const CAT_ACTIVE = 1;
    public const CAT_INACTIVE = 0;

    protected $fillable = [
        'cat_name',
        'cat_code',
        'cat_obs',
        'cat_active',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
