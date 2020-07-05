<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
    ];
    protected $table="especialidades";
}
