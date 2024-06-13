<?php

namespace App\Livewire;

use Livewire\Component;

class ProductMenu extends Component
{
    public $productName = '';
    public $obs = '';
    public $price = 0;
    public $itemQuantity = 0;
    public $id = 0;
    public $productImage = '';

    public function render()
    {
        return view(
            'livewire.product-menu',
            [
                'id' => $this->id,
                'productName' => $this->productName,
                'obs' => $this->obs,
                'price' => $this->price
            ]
        );
    }

    public function addProduct()
    {
        $this->itemQuantity++;
    }

    public function subProduct()
    {
        if ($this->itemQuantity >= 0) {
            $this->itemQuantity--;
        }
    }
}
