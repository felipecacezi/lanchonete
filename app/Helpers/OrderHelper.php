<?php

namespace App\Helpers;

use App\Models\Product;

class OrderHelper
{
    public function calculateProductValue(int $productId, int $productQuantity):string
    {
        $vlTotal = '0,00';
        if ($productId && $productQuantity) {
            $arProduct = Product::find($productId)
                ->get()
                ->toArray();
            $vlTotal = number_format(
                    ($arProduct[0]['product_price'] * $productQuantity),
                    2,
                    ",",
                    "."
            );

        }

        return $vlTotal;
    }
}