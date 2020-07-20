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

    public function create(){  }

    public function store(Request $request)
    {
        $especialidade = new Especialidade([
            'nome' => $request->get('nome'),
            'descricao' => $request->get('descricao')
        ]);

        $especialidade->save();
        return json_encode($especialidade);
    }

    public function show($id)
    {
        $especialidade = Especialidade::find($id);

        if(isset($especialidade)){
            return json_encode($especialidade);
        }

        return response('Especialidade não encontrada', 404);
    }

    public function edit($id) {}

    public function update(Request $request, $id)
    {

        $especialidade = Especialidade::find($id);

        if(isset($especialidade)){
            $especialidade->nome = $request->get('nome');
            $especialidade->descricao = $request->get('descricao');
            $especialidade->save();

            return json_encode($especialidade);
        }

        return response('Especialidade não encontrada', 404);
    }

    public function destroy($id)
    {
        $especialidade = Especialidade::find($id);

        if(isset($especialidade)){
            $especialidade->delete();
            return response('OK', 200);
        }

        return response('Especialidade não encontrada', 404);
    }

    public function loadJson(){
        $especialidades = Especialidade::all();
        return json_encode($especialidades);
    }
}
