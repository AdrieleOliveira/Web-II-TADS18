<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('curso', 'CursoController');
Route::resource('disciplina', 'DisciplinaController');
Route::resource('professor', 'ProfessorController');
Route::resource('aluno', 'AlunoController');
Route::resource('matricula', 'MatriculaController');
