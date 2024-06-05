<?php

use App\Http\Controllers\ProfileController;
use App\Models\Menu;
use App\Models\MenuProduct;
use Illuminate\Support\Facades\Route;

Route::get('/cardapio', function () {

    $arMenus = Menu::all()->toArray();

    foreach ($arMenus as $key => $menu) {        
        $arMenus[$key]['products'] = MenuProduct::where('menu_id', $menu['id'])
            ->join('products', 'products.id', '=', 'menu_products.product_id')
            ->get()
            ->toArray();
    }
    
    return view('cardapio', [ 'menus' => [$arMenus] ] );
});

require __DIR__.'/auth.php';
