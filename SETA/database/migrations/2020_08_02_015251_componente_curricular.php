<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ComponenteCurricular extends Migration
{
    public function up()
    {
        Schema::create('componentes_curriculares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->integer('carga_horaria');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('componentes_curriculares');
    }
}
