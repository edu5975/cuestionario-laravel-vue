<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_models', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('gustos');
            $table->string('tipo_desarrollador');
            $table->boolean('l_java');
            $table->boolean('l_js');
            $table->boolean('l_php');
            $table->boolean('l_python');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas_models');
    }
}
