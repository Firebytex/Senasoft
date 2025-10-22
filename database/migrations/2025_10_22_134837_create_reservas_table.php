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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vuelo_ida_id')->constrained('vuelos');
            $table->foreignId('vuelo_regreso_id')->nullable()->constrained('vuelos');
            $table->string('pagador_nombre');
            $table->string('pagador_correo');
            $table->string('pagador_telefono');
            $table->string('metodo_pago');
            $table->decimal('valor_total',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
