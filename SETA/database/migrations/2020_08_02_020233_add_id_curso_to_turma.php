<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCursoToTurma extends Migration
{
    public function up()
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    public function down()
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->dropForeign(['curso_id']);
            $table->dropColumn(['curso_id']);
        });
    }
}
