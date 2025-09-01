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
        Schema::create('purchase_orders_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order-id')->constrained('purchase_orders')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('store_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders_items');
    }
};
