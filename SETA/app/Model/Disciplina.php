<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'numero_bimestres',
        'componente_curricular_id',
        'turma_id'
    ];

    private $turma;
    private $componente;
}
