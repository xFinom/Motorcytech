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
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('placa');
            $table->string('serial_num');
            $table->string('motor_num');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('motorcycle_types')->onDelete('cascade');
            $table->foreignId('id_cliente')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycles');
    }
};
