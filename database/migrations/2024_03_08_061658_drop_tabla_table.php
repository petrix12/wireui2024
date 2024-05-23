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
        //Schema::drop('tabla');
        Schema::dropIfExists('tabla');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Aquí se deberá crear la tabla tabla
        Schema::create('tabla', function (Blueprint $table) {
            $table->id();
            // ...
            $table->timestamps();
        });        
    }
};
