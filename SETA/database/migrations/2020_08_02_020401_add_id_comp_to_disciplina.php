<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdCompToDisciplina extends Migration
{
    public function up()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->unsignedBigInteger('componente_curricular_id');
            $table->foreign('componente_curricular_id')->references('id')->on('componentes_curriculares');
        });
    }

    public function down()
    {
        Schema::table('disciplinas', function (Blueprint $table) {
            $table->dropForeign(['componente_curricular_id']);
            $table->dropColumn(['componente_curricular_id']);
        });
    }
}
