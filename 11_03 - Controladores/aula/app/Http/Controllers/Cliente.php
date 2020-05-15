<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cliente extends Controller
{
    public $clientes = array(
        array(
            'id' => 1,
            'nome' => "Daniel",
            'email' => "daniel@daniel"
        ),
        array(
            'id' => 2,
            'nome' => "João",
            'email' => "joao@joao"
        ),
    );

    public function __construct(){

        $aux = session('clientes');

        if(!isset($aux)){
            session(['clientes' => $this->clientes]);
        }
    }

    public function index() {

        $clientes = session('clientes');
        return view('cliente.index', compact('clientes'));

        //return view('clientes.index')->with('clientes', $clientes);
        //return view('cliente.index', compact(['clientes', 'professores']));
    }


    public function create(){
        return view('cliente.create');
    }


    public function store(Request $request){

        $aux = session('clientes');
        $ids = array_column($aux, 'id');

        if(count($ids) > 0){
            $new_id = max($ids) + 1;
        } else {
            $new_id = 1;
        }

        $novo = [
            'id' => $new_id,
            'nome' => $request->nome,
            'email' => $request->email
        ];

        array_push($aux, $novo);
        session(['clientes' => $aux]);

        return redirect()->route('cliente.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
