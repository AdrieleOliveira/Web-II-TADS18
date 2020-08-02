<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class ComponenteCurricular extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'carga_horaria',
        'curso_id'
    ];

    protected $table = "componentes_curriculares";

    private $curso;
}
