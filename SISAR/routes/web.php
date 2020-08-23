<?php

use Illuminate\Support\Facades\Route;

Route::resource('curso', 'CursoController');
Route::resource('disciplina', 'DisciplinaController');
Route::resource('professor', 'ProfessorController');
Route::resource('aluno', 'AlunoController');
Route::resource('matricula', 'MatriculaController');

Route::get('/', function () {
    return view('welcome');
})->name('home');
