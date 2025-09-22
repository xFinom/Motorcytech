<?php

use App\Enums\PaymentStatus;
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
        Schema::create('service_orders_bills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('description');
            $table->double('price');
            $table->enum('payment_status', PaymentStatus::values())->default(PaymentStatus::Pendiente->value);
            $table->foreignUlid('service_order_id')->constrained('service_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders_bills');
    }
};
