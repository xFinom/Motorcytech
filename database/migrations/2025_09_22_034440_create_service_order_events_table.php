<?php

use App\Enums\ApprovalStatus;
use App\Enums\ServiceOrderEvents;
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
        Schema::create('service_order_events', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('service_order_id')->constrained('service_orders');
            $table->enum('type', ServiceOrderEvents::values());
            $table->enum('approval_status', ApprovalStatus::values())->nullable()->default(null);
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_order_events');
    }
};
