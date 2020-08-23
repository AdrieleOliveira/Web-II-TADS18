<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = [
        'nome', 'email'
    ];

    public function disciplina(){
        return $this->hasMany('\App\Disciplina');
    }
}
