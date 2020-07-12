<?php

namespace App\Http\Controllers;

use App\Especialidade;
use App\Veterinario;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{

    public function index()
    {
        $veterinarios = Veterinario::all();
        return view('veterinario.index', compact('veterinarios'));
    }

    public function create()
    {
        $especialidades = Especialidade::all();
        return view('veterinario.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'crmv' => 'required|max:6|min:6',
        ];

        $msgs = [
            'required' => 'O preenchimento do campo [:attribute] é obrigatório!',
            'max' => 'O campo [:attribute] possui tamanho máximo de [:max] caracteres!',
            'min' => 'O campo [:attribute] possui tamanho mínimo de [:min] caracteres!'
        ];

        $request->validate($regras, $msgs);

        $veterinario = new Veterinario([
            'nome' => $request->get('nome'),
            'crmv' => $request->get('crmv'),
            'especialidade_id' => $request->get('especialidade_id')
        ]);

        $veterinario->save();
        return redirect()->route('veterinario.index');
    }

    public function show($id)
    {
        $veterinario = Veterinario::find($id);
        $veterinario->especialidade = Especialidade::find($veterinario->id);
        return view('veterinario.show', compact('veterinario'));
    }

    public function edit($id)
    {
        $veterinario = Veterinario::find($id);
        $especialidades = Especialidade::all();

        return view('veterinario.edit', compact('veterinario', 'especialidades'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:100|min:10',
            'crmv' => 'required|max:6|min:6',
        ];

        $msgs = [
            'required' => 'O preenchimento do campo [:attribute] é obrigatório!',
            'max' => 'O campo [:attribute] possui tamanho máximo de [:max] caracteres!',
            'min' => 'O campo [:attribute] possui tamanho mínimo de [:min] caracteres!'
        ];

        $request->validate($regras, $msgs);

        $veterinario = Veterinario::find($id);
        $veterinario->nome = $request->get('nome');
        $veterinario->crmv = $request->get('crmv');
        $veterinario->especialidade_id = $request->get('especialidade_id');
        $veterinario->save();

        return redirect()->route('veterinario.index');
    }

    public function destroy($id)
    {
        $veterinario = Veterinario::find($id);
        $veterinario->delete();

        return redirect()->route('veterinario.index');
    }
}
