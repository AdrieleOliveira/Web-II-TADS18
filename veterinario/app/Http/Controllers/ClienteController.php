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
        $regras = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|unique:clientes',
            'telefone' => 'required|max:13|min:11',
        ];

        $msgs = [
            'required' => 'O preenchimento do campo [:attribute] é obrigatório!',
            'max' => 'O campo [:attribute] possui tamanho máximo de [:max] caracteres!',
            'min' => 'O campo [:attribute] possui tamanho mínimo de [:min] caracteres!',
            'email.unique' => 'Já existe um cliente cadastrado para o e-mail especificado!'
        ];

        $request->validate($regras, $msgs);

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
        $regras = [
            'nome' => 'required|max:100|min:10',
            'telefone' => 'required|max:13|min:11',
        ];

        $msgs = [
            'required' => 'O preenchimento do campo [:attribute] é obrigatório!',
            'max' => 'O campo [:attribute] possui tamanho máximo de [:max] caracteres!',
            'min' => 'O campo [:attribute] possui tamanho mínimo de [:min] caracteres!',
        ];

        $request->validate($regras, $msgs);

        $cliente = new Cliente([
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'telefone' => $request->get('telefone')
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
