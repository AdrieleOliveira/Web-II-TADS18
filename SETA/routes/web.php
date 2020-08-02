<?php

use Illuminate\Support\Facades\Route;

Route::resource('curso', 'CursoController');
Route::resource('componente', 'ComponenteCurricularController');
Route::resource('turma', 'TurmaController');
Route::resource('disciplina', 'DisciplinaController');
Route::resource('configPesos', 'ConfigPesosController');
Route::resource('configConceitos', 'ConfigConceitosController');

Route::get('/', function () {
    return view('welcome');
})->name('home');

