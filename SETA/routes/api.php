<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('curso/load', 'CursoController@loadJson');
Route::resource('curso', 'CursoController');
Route::get('componente/load', 'ComponenteCurricularController@loadJson');
Route::resource('componente', 'ComponenteCurricularController');
Route::get('turma/load', 'TurmaController@loadJson');
Route::resource('turma', 'TurmaController');
Route::resource('disciplina', 'DisciplinaController');
Route::resource('configPesos', 'ConfigPesosController');
Route::resource('configConceitos', 'ConfigConceitosController');
