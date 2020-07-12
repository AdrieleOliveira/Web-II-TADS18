<?php

namespace App\Http\Controllers;

use App\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{

    public function index()
    {
        $especialidades = Especialidade::all();
        return view('especialidade.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidade.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:30|min:5',
            'descricao' => 'required|max:250|min:5',
        ];

        $msgs = [
            'required' => 'O preenchimento do campo [:attribute] é obrigatório!',
            'max' => 'O campo [:attribute] possui tamanho máximo de [:max] caracteres!',
            'min' => 'O campo [:attribute] possui tamanho mínimo de [:min] caracteres!'
        ];

        $request->validate($regras, $msgs);

        $especialidade = new Especialidade([
            'nome' => $request->get('nome'),
            'descricao' => $request->get('descricao')
        ]);

        $especialidade->save();
        return redirect()->route('especialidade.index');
    }

    public function show($id)
    {
        $especialidade = Especialidade::find($id);
        return view('especialidade.show', compact('especialidade'));
    }

    public function edit($id)
    {
       $especialidade = Especialidade::find($id);
       return view('especialidade.edit', compact('especialidade'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:30|min:5',
            'descricao' => 'required|max:250|min:5',
        ];

        $msgs = [
            'required' => 'O preenchimento do campo [:attribute] é obrigatório!',
            'max' => 'O campo [:attribute] possui tamanho máximo de [:max] caracteres!',
            'min' => 'O campo [:attribute] possui tamanho mínimo de [:min] caracteres!'
        ];

        $request->validate($regras, $msgs);

        $especialidade = Especialidade::find($id);
        $especialidade->nome = $request->get('nome');
        $especialidade->descricao = $request->get('descricao');
        $especialidade->save();

        return redirect()->route('especialidade.index');
    }

    public function destroy($id)
    {
        $especialidade = Especialidade::find($id);
        $especialidade->delete();

        return redirect()->route('especialidade.index');
    }
}
