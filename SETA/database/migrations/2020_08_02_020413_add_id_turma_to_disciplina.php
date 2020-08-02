<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdTurmaToDisciplina extends Migration
{
    public function up()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->unsignedBigInteger('turma_id');
            $table->foreign('turma_id')->references('id')->on('turmas');

        });
    }

    public function down()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->dropForeign(['turma_id']);
            $table->dropColumn(['turma_id']);
        });
    }
}
