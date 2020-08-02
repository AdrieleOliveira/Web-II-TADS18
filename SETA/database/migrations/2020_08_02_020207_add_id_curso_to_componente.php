<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCursoToComponente extends Migration
{
    public function up()
    {
        Schema::table('componentes_curriculares', function (Blueprint $table) {
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    public function down()
    {
        Schema::table('componentes_curriculares', function (Blueprint $table) {
            $table->dropForeign(['curso_id']);
            $table->dropColumn(['curso_id']);
        });
    }
}
