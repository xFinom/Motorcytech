<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ServiceOrderStatus;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps('entry_date');
            $table->timestamps('delivery_date');
            $table->integer('motorcycle_id');
            $table->string('status')->default(ServiceOrderStatus::Ingresado->value);
            $table->integer('client_id');
            $table->longText('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
