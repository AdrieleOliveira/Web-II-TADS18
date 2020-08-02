<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ConfigConceitos extends Model
{
    protected $fillable = [
        'id',
        'conceito_a',
        'conceito_b',
        'conceito_c',
        'conceito_d',
        'disciplina_id'
    ];

    protected $table = "config_conceitos";

    private $disciplina;
}
