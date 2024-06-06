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
        Schema::create('elaboracions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bocadillo_id');
            $table->unsignedBigInteger('ingrediente_id');
            $table->double('cantidad');
            $table->timestamps();

            $table->foreign('bocadillo_id')->references('id')->on('bocadillos')->onDelete('cascade');
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elaboracions');
    }
};
