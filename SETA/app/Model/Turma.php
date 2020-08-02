<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'ano',
        'abreviatura',
        'curso_id'
    ];

    private $curso;
}
