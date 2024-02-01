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
        Schema::create('tablaable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tablaable_id');
            $table->string('tablaable_type');
            $table->unsignedBigInteger('tabla_id');
            $table->foreign('tabla_id')->references('id')->on('tablas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tablaable');
    }
};
