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
        Schema::table('items', function (Blueprint $table) {
            $table->integer('item_quantity')->default(0);
            $table->integer('item_min_quantity')->default(0);
            $table->integer('item_max_quantity')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('item_quantity');
            $table->dropColumn('item_min_quantity');
            $table->dropColumn('item_max_quantity');
        });
    }
};
