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
        Schema::create('vuelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ciudad_origen_id')->constrained('ciudades');
            $table->foreignId('ciudad_destino_id')->constrained('ciudades');
            $table->foreignId('modelo_avion_id')->constrained('modelos_avion');
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('precio',10,2);
            $table->integer('asientos_disponibles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vuelos');
    }
};
