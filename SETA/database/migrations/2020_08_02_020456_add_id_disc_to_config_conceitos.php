<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDiscToConfigConceitos extends Migration
{
    public function up()
    {
        Schema::table('config_conceitos', function (Blueprint $table) {
            $table->unsignedBigInteger('disciplina_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        });
    }

    public function down()
    {
        Schema::table('config_conceitos', function (Blueprint $table) {
            $table->dropForeign(['disciplina_id']);
            $table->dropColumn(['disciplina_id']);
        });
    }
}
