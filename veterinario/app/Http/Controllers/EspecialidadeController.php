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
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
        ]);

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
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
        ]);

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
