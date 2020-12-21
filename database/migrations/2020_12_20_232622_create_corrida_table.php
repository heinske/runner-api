<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorridaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('prova_id');
            $table->unsignedInteger('corredor_id');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();
            $table->timestamps();

            $table->foreign('corredor_id')->references('id')->on('corredores');
            $table->foreign('prova_id')->references('id')->on('provas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corridas');
    }
}
