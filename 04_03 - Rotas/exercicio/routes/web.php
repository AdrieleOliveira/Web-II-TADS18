<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    //return view('welcome');
    return "<h1>Rota Principal</h1>";
});

Route::prefix('/aluno')->group(function (){

    Route::get('/', function (){

        $dados = [["nome" => "Adriele"],
            ["nome" => "Matheus"],
            ["nome" => "Claudio"],
            ["nome" => "Eduardo"],
            ["nome" => "José"]];

        $alunos = "<ol>";

        for($i = 0; $i < count($dados); $i++){
            $alunos = $alunos . "<li>".$dados[$i]['nome']."</li>";
        }

        $alunos = $alunos . "</ol>";
        return $alunos;

    })->name('aluno');

    Route::get('/limite/{total}', function ($total){

        $dados = [["nome" => "Adriele"],
            ["nome" => "Matheus"],
            ["nome" => "Claudio"],
            ["nome" => "Eduardo"],
            ["nome" => "José"]];

        $alunos = "<ol>";

        if($total <= count($dados)){
            for($i = 0; $i < $total; $i++){
                $alunos = $alunos . "<li>".$dados[$i]['nome']."</li>";
            }
        }

        $alunos = $alunos . "</ol>";
        return $alunos;

    })->name('aluno.limite')->where('total', '[0-9]+');

    Route::get('/matricula/{matricula}', function ($matricula){

        $dados = [["nome" => "Adriele", "matricula" => 1],
            ["nome" => "Matheus", "matricula" => 2],
            ["nome" => "Claudio", "matricula" => 3],
            ["nome" => "Eduardo", "matricula" => 4],
            ["nome" => "José", "matricula" => 5]];

        $alunos = "<ul>";

        $pos = array_search($matricula, array_column($dados, 'matricula'));

        if($pos >= 0) {
            $alunos = $alunos . "<li>" . $dados[$pos]['nome'] . "</li>";
        }

        $alunos = $alunos . "</ul>";
        return $alunos;

    })->name('aluno.matricula')->where('matricula', '[0-9]+');

    Route::get('/nome/{nome}', function ($nome){

        $dados = [["nome" => "Adriele", "matricula" => 1],
            ["nome" => "Matheus", "matricula" => 2],
            ["nome" => "Claudio", "matricula" => 3],
            ["nome" => "Eduardo", "matricula" => 4],
            ["nome" => "José", "matricula" => 5]];

        $alunos = "<ul>";

        $pos = array_search($nome, array_column($dados, 'nome'));

        if($pos > 0) {
            $alunos = $alunos . "<li>" . $dados[$pos]['nome'] . "</li>";
        } else {
            $alunos = $alunos . "<li>Não encontrado</li>";
        }

        $alunos = $alunos . "</ul>";
        return $alunos;

    })->name('/aluno.nome')->where('nome', '[A-Za-z]+');
});



Route::prefix('/nota')->group(function (){

    Route::get('/', function (){
        $dados = [["nome" => "Adriele", "matricula" => 1, "nota" => 8],
            ["nome" => "Matheus", "matricula" => 2, "nota" => 7],
            ["nome" => "Claudio", "matricula" => 3, "nota" => 9],
            ["nome" => "Eduardo", "matricula" => 4, "nota" => 5],
            ["nome" => "José", "matricula" => 5, "nota" => 6]];

        $notas = "<table>";
        $notas = $notas . "<tr>";
        $notas = $notas . "<th>Matrícula</th>";
        $notas = $notas . "<th>Aluno</th>";
        $notas = $notas . "<th>Nota</th>";
        $notas = $notas . "</tr>";

        for($i = 0; $i < count($dados); $i++){
            $notas = $notas . "<tr>";
            $notas = $notas . "<td>" . $dados[$i]['matricula'] . "</td>";
            $notas = $notas . "<td>" . $dados[$i]['nome'] . "</td>";
            $notas = $notas . "<td>" . $dados[$i]['nota'] . "</td>";
            $notas = $notas . "</tr>";
        }

        $notas = $notas . "</table>";
        return $notas;
    })->name('nota');

    Route::get('/limite/{total}', function ($total){

        $dados = [["nome" => "Adriele", "matricula" => 1, "nota" => 8],
            ["nome" => "Matheus", "matricula" => 2, "nota" => 7],
            ["nome" => "Claudio", "matricula" => 3, "nota" => 9],
            ["nome" => "Eduardo", "matricula" => 4, "nota" => 5],
            ["nome" => "José", "matricula" => 5, "nota" => 6]];

        $notas = "<table>";
        $notas = $notas . "<tr>";
        $notas = $notas . "<th>Matrícula</th>";
        $notas = $notas . "<th>Aluno</th>";
        $notas = $notas . "<th>Nota</th>";
        $notas = $notas . "</tr>";

        if($total <= count($dados)) {

            for ($i = 0; $i < $total; $i++) {
                $notas = $notas . "<tr>";
                $notas = $notas . "<td>" . $dados[$i]['matricula'] . "</td>";
                $notas = $notas . "<td>" . $dados[$i]['nome'] . "</td>";
                $notas = $notas . "<td>" . $dados[$i]['nota'] . "</td>";
                $notas = $notas . "</tr>";
            }
        }

        $notas = $notas . "</table>";
        return $notas;
    })->name('nota.limite')->where('total', '[0-9]+');;

    Route::get('/lancar/{nota}/{matricula}/{nome?}', function ($nota, $matricula, $nome = null){

        $dados = [["nome" => "Adriele", "matricula" => 1, "nota" => 8],
            ["nome" => "Matheus", "matricula" => 2, "nota" => 7],
            ["nome" => "Claudio", "matricula" => 3, "nota" => 9],
            ["nome" => "Eduardo", "matricula" => 4, "nota" => 5],
            ["nome" => "José", "matricula" => 5, "nota" => 6]];

        $flag = false;

        for($i = 0; $i < count($dados); $i++) {
            if ($nome != null) {
                if ($dados[$i]['nome'] == $nome) {
                    $dados[$i]['nota'] = $nota;
                    $flag = true;
                    break;
                }
            } else {
                if ($dados[$i]['matricula'] == $matricula) {
                    $dados[$i]['nota'] = $nota;
                    $flag = true;
                    break;
                }
            }
        }

        if($flag) {

            $notas = "<table>";
            $notas = $notas . "<tr>";
            $notas = $notas . "<th>Matrícula</th>";
            $notas = $notas . "<th>Aluno</th>";
            $notas = $notas . "<th>Nota</th>";
            $notas = $notas . "</tr>";

            for ($i = 0; $i < count($dados); $i++) {
                $notas = $notas . "<tr>";
                $notas = $notas . "<td>" . $dados[$i]['matricula'] . "</td>";
                $notas = $notas . "<td>" . $dados[$i]['nome'] . "</td>";
                $notas = $notas . "<td>" . $dados[$i]['nota'] . "</td>";
                $notas = $notas . "</tr>";
            }

            $notas = $notas . "</table>";
            return $notas;
        } else {
            return "<ul><li>Não encontrado</li></ul>";
        }
    })->name('nota.lancar')->where('nota', '[0-9]+')->where('matricula', '[0-9]+');

    Route::get('/conceito/{na}/{nb}/{nc}', function ($na, $nb, $nc){

        $dados = [["nome" => "Adriele", "matricula" => 1, "nota" => 8],
            ["nome" => "Matheus", "matricula" => 2, "nota" => 7],
            ["nome" => "Claudio", "matricula" => 3, "nota" => 9],
            ["nome" => "Eduardo", "matricula" => 4, "nota" => 5],
            ["nome" => "José", "matricula" => 5, "nota" => 6]];


        $notas = "<table>";
        $notas = $notas . "<tr>";
        $notas = $notas . "<th>Matrícula</th>";
        $notas = $notas . "<th>Aluno</th>";
        $notas = $notas . "<th>Nota</th>";
        $notas = $notas . "</tr>";


        for ($i = 0; $i < count($dados); $i++) {
            $notas = $notas . "<tr>";
            $notas = $notas . "<td>" . $dados[$i]['matricula'] . "</td>";
            $notas = $notas . "<td>" . $dados[$i]['nome'] . "</td>";

            if($dados[$i]['nota'] >= $na){
                $notas = $notas . "<td> A </td>";
            } else if($dados[$i]['nota'] < $na && $dados[$i]['nota'] >= $nb){
                $notas = $notas . "<td> B </td>";
            } else if($dados[$i]['nota'] < $nb && $dados[$i]['nota'] >= $nc){
                $notas = $notas . "<td> C </td>";
            } else {
                $notas = $notas . "<td> D </td>";
            }

            $notas = $notas . "</tr>";
        }

        $notas = $notas . "</table>";
        return $notas;
    })->name('nota.conceito')->where('na', '[0-9]+')->where('nb', '[0-9]+')->where('nc', '[0-9]+');

    Route::post('/conceito/{na}/{nb}/{nc}', function ($na, $nb, $nc){

        $dados = [["nome" => "Adriele", "matricula" => 1, "nota" => 8],
            ["nome" => "Matheus", "matricula" => 2, "nota" => 7],
            ["nome" => "Claudio", "matricula" => 3, "nota" => 9],
            ["nome" => "Eduardo", "matricula" => 4, "nota" => 5],
            ["nome" => "José", "matricula" => 5, "nota" => 6]];


        $notas = "<table>";
        $notas = $notas . "<tr>";
        $notas = $notas . "<th>Matrícula</th>";
        $notas = $notas . "<th>Aluno</th>";
        $notas = $notas . "<th>Nota</th>";
        $notas = $notas . "</tr>";


        for ($i = 0; $i < count($dados); $i++) {
            $notas = $notas . "<tr>";
            $notas = $notas . "<td>" . $dados[$i]['matricula'] . "</td>";
            $notas = $notas . "<td>" . $dados[$i]['nome'] . "</td>";

            if($dados[$i]['nota'] >= $na){
                $notas = $notas . "<td> A </td>";
            } else if($dados[$i]['nota'] < $na && $dados[$i]['nota'] >= $nb){
                $notas = $notas . "<td> B </td>";
            } else if($dados[$i]['nota'] < $nb && $dados[$i]['nota'] >= $nc){
                $notas = $notas . "<td> C </td>";
            } else {
                $notas = $notas . "<td> D </td>";
            }

            $notas = $notas . "</tr>";
        }

        $notas = $notas . "</table>";
        return $notas;
    })->name('nota.conceito')->where('na', '[0-9]+')->where('nb', '[0-9]+')->where('nc', '[0-9]+');
});

