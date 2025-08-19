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
        Schema::create('service_orders_spare_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->constrained('service_orders')->onDelete('cascade');
            $table->foreignId('id_spare')->constrained('spare_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders_spare_parts');
    }
};
