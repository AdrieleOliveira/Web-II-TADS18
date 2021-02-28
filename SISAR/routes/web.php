<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AccessLevel;


Route::middleware('auth', 'AccessLevel')->group(function (){
    Route::resource('curso', 'CursoController');
    Route::resource('disciplina', 'DisciplinaController');
    Route::resource('professor', 'ProfessorController');
    Route::resource('aluno', 'AlunoController');
    Route::resource('matricula', 'MatriculaController');
    Route::get('negado', 'NegadoController@index')->name('negado');

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/home', function (){
        return view('welcome');
    })->name('home');
});

Auth::routes();


