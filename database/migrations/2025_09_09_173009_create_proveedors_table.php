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
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
             $table->string('empresa'); 
            $table->string('representante')->nullable(); 
            $table->string('direccion')->nullable(); 
            $table->string('correo')->nullable()->unique(); 
            $table->string('telefono')->nullable();
            $table->string('producto'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
