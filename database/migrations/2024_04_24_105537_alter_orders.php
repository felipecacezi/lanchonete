<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('item_active', 'order_active');
            $table->integer('order_status'); //0-pendente, 1-pedido em preparo, 2-pedido pronto, 3-pago/finalizado, 4-cancelado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('order_active', 'item_active');
        });
    }
};
