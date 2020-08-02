<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigConceito extends Migration
{
    public function up()
    {
        Schema::create('config_conceitos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('conceito_a');
            $table->double('conceito_b');
            $table->double('conceito_c');
            $table->double('conceito_d');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_conceitos');
    }
}
