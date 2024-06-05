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
        Schema::create('menu_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->on('menus');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_products');
    }
};
