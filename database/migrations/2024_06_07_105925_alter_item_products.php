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
        Schema::table('item_products', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable(true)->change();
            $table->unsignedBigInteger('product_id')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_products', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable(false)->change();
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
        });
    }
};
