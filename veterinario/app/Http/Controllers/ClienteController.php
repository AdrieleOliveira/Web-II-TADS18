<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index', compact('clientes'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $cliente = new Cliente([
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone')
        ]);

        $cliente->save();

        return json_encode($cliente);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if(isset($cliente)){
            return json_encode($cliente);
        }

        return response('Cliente não encontrado', 404);
    }

    public function edit($id){}

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if(isset($cliente)){
            $cliente->nome = $request->get('nome');
            $cliente->email = $request->get('email');
            $cliente->telefone = $request->get('telefone');
            $cliente->save();
            return json_encode($cliente);
        }

        return response('Cliente não encontrado', 404);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if(isset($cliente)){
            $cliente->delete();
            return response('OK', 200);
        }

        return response('Cliente não encontrado', 404);
    }

    public function loadJson(){
        $cliente = Cliente::all();
        return json_encode($cliente);
    }
}
