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

    public function create()
    {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        $cliente = new Cliente([
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone')
        ]);

        $cliente->save();

        return redirect()->route('cliente.index');
    }

    public function show($id)
    {
        $dados = Cliente::find($id);
        return view('cliente.show', compact('dados'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('cliente.edit', compact('cliente'));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ]);

        $cliente = Cliente::find($id);
        $cliente->nome = $request->get('nome');
        $cliente->email = $request->get('email');
        $cliente->telefone = $request->get('telefone');
        $cliente->save();

        return redirect()->route('cliente.index');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('cliente.index');
    }
}
