<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigPeso extends Migration
{
    public function up()
    {
        Schema::create('config_pesos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('trabalho');
            $table->double('avaliacao');
            $table->double('primeiro_bimestre');
            $table->double('segundo_bimestre');
            $table->double('terceiro_bimestre');
            $table->double('quarto_bimestre');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_pesos');
    }
}
