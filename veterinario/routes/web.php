<?php

use Illuminate\Support\Facades\Route;

Route::resource('cliente', 'ClienteController');
Route::resource('especialidade', 'EspecialidadeController');
Route::resource('veterinario', 'VeterinarioController');

Route::redirect('/', 'cliente', 301);

