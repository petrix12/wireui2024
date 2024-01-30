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
        Schema::create('tablas', function (Blueprint $table) {
            $table->string('campo1');
            $table->unsignedBigInteger('tablaable_id');
            $table->string('tablaable_type');
            // Definición de la llave primaria compuesta
            $table->primary(['tablaable_id', 'tablaable_type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablas');
    }
};
