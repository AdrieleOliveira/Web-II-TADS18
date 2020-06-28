<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Cidade extends Controller {

    public $cidades = [[
        'id' => 1,
        'nome' => 'Antonina',
        'porte' => 'Pequeno'
    ]];

    public function __construct(){

        $aux = session('cidades');

        if(!isset($aux)){
            session(['cidades' => $this->cidades]);
        }
    }

    public function index() {

        $cidades = session('cidades');
        return view('cidade.index', compact('cidades'));
    }

    public function create() {

        return view ('cidade.create');
    }

    public function store(Request $request){

        $aux = session('cidades');
        $ids = array_column($aux, 'id');

        if(count($ids) > 0){
            $new_id = max($ids) + 1;
        } else {
            $new_id = 1;
        }

        $novo = [
            'id' => $new_id,
            'nome' => $request->nome,
            'porte' => $request->porte
        ];

        array_push($aux, $novo);
        session(['cidades' => $aux]);

        return redirect()->route('cidade.index');
    }

    public function show($id) {

        $aux = session('cidades');

        $indice = array_search($id, array_column($aux, 'id'));
        $dados = $aux[$indice];

        return view('cidade.show', compact('dados'));
    }

    public function edit($id){

        $aux = session('cidades');
        $indice = array_search($id, array_column($aux, 'id'));
        $dados = $aux[$indice];

        return view('cidade.edit', compact('dados'));

    }

    public function update(Request $request, $id) {

        $alterado = [
            'id' => $id,
            'nome' => $request->nome,
            'porte' => $request->porte
        ];

        $aux = session('cidades');
        $indice = array_search($id, array_column($aux, 'id'));

        $aux[$indice] = $alterado;
        session(['cidades' => $aux]);

        return redirect()->route('cidade.index');
    }

    public function destroy($id){

        $aux = session('cidades');

        $indice = array_search($id, array_column($aux, 'id'));

        unset($aux[$indice]);

        $aux2 = array();
        foreach ($aux as $a){
            array_push($aux2, $a);
        }

        session(['cidades' => $aux2]);

       return redirect()->route('cidade.index');
    }
}
