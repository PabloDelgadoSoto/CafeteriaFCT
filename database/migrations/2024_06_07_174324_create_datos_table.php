<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_datos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->string('nia');
            $table->string('name');
            $table->double('hora');
            $table->string('bocadillo_id');
            $table->string('ingrediente_extra');
            $table->string('descartados');
            $table->integer('cantidad');
            $table->boolean('completado')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('datos');
    }
}
