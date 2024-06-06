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
        Schema::create('bocadillos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('precio');
            $table->double('descuento')->default(null)->nullable();
            $table->boolean('disponible')->default(false);
            $table->boolean('desmontable')->default(false);
            $table->unsignedBigInteger('tipo_id');
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bocadillos');
    }
};
