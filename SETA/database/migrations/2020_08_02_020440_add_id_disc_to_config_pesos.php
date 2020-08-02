<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDiscToConfigPesos extends Migration
{
    public function up()
    {
        Schema::table('config_pesos', function (Blueprint $table) {
            $table->unsignedBigInteger('disciplina_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }


    public function down()
    {
        Schema::table('config_pesos', function (Blueprint $table) {
            $table->dropForeign(['disciplina_id']);
            $table->dropColumn(['disciplina_id']);
        });
    }
}
