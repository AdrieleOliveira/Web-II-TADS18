<?php

use Illuminate\Support\Facades\Route;

Route::get('/',  function (){
    return view('default');
});

Route::resource('cidade', 'Cidade');

//Route::prefix('/cidade')->group(function (){
//
//    Route::get('/', 'Cidade@index')->name('cidade');
//});

//{{ route('cidade') }}
