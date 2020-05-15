<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \Illuminate\Http\Request;

Route::get('/', function () {
    return "<h2>Rota Principal</h2>";
});

Route::get('/cliente', function () {

    $clientes = "<ul>".
            "<li>Carlos Eduardo</li>".
            "<li>Maria Claudia</li>".
            "<li>João Pedro</li>".
            "</ul>";
    return $clientes;
})->name('cliente');

Route::get('/cliente/{total}', function ($total) {

    $dados =    [["nome" => "Carlos Eduardo"],
                 ["nome" => "Maria Claudia"],
                 ["nome" => "João Pedro"]];
    $clientes = "<ul>";
    if($total <= count($dados)) {
        for($a=0; $a<$total; $a++) {
            $clientes = $clientes."<li>".$dados[$a]['nome']."</li>";
        }
    }
    $clientes = $clientes."</ul>";
    return $clientes;
});

Route::get('/cliente/{total}/{nome}', function ($total, $nome) {

    $clientes = "<ul>";
    for($a=0; $a<$total; $a++) {
            $clientes = $clientes."<li>$nome</li>";
    }
    $clientes = $clientes."</ul>";
    return $clientes;
});

Route::get('/animal/{total}/{raca?}', function ($total, $raca=null) {

    $dados =    [["raca" => "Bulldog Inglês"],
                 ["raca" => "Street Dog"],
                 ["raca" => "Labrador"],
                 ["raca" => "Pug"]];

    $animais = "<ul>";
    if($raca != null) {
        for($a=0; $a<$total; $a++) {
                $animais = $animais."<li>$raca</li>";
        }
    }
    else if($total <= count($dados)) {
        for($a=0; $a<$total; $a++) {
            $animais = $animais."<li>".$dados[$a]['raca']."</li>";
        }
    }
    $animais = $animais."</ul>";
    return $animais;
});

Route::get('/veterinario/{total}/{nome}', function ($total, $nome) {

    $vets = "<ul>";
    for($a=0; $a<$total; $a++) {
            $vets = $vets."<li>$nome</li>";
    }
    $vets = $vets."</ul>";
    return $vets;

})->where('total', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::prefix('/consulta')->group(function() {

    Route::get('/', function() {
        return view('consulta');
    })->name('consulta');

    Route::get('/agendar', function() {
        return view('agendar');
    })->name('consulta.agendar');

    Route::get('/cancelar', function() {
        return view('cancelar');
    })->name('consulta.cancelar');
});

Route::redirect('/', 'cliente', 301);

Route::get('/veterinario', function () {
    return redirect()->route('cliente');
});

Route::post('/veterinario/add', function (Request $request) {
    return "<h1>Adicionar Veterinário (POST)</h1>";
});


