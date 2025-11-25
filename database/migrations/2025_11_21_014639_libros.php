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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedInteger('stock')->default(0);
            $table->string('proveedor')->nullable();
            $table->enum('estado', ['disponible', 'no_disponible'])->default('disponible');
            $table->date('fecha')->nullable();
            $table->foreignId('tipo_producto_id')
                  ->nullable()
                  ->constrained('tipo_productos')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
