<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ConfigPesos extends Model
{
    protected $fillable = [
        'id',
        'trabalho',
        'avaliacao',
        'primeiro_bimestre',
        'segundo_bimestre',
        'terceiro_bimestre',
        'quarto_bimestre',
        'disciplina_id'
    ];

    protected $table = "config_pesos";

    private $disciplina;
}
