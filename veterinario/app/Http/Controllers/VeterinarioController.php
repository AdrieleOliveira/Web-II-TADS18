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

    public function create() {}

    public function store(Request $request)
    {
        $veterinario = new Veterinario([
            'nome' => $request->get('nome'),
            'crmv' => $request->get('crmv'),
            'especialidade_id' => $request->get('especialidade_id')
        ]);

        $veterinario->save();
        return json_encode($veterinario);
    }

    public function show($id)
    {
        $veterinario = Veterinario::find($id);

        if(isset($veterinario)){
            return json_encode($veterinario);
        }

        return response('Veterinário não encontrado', 404);
    }

    public function edit($id){}

    public function update(Request $request, $id)
    {
        $veterinario = Veterinario::find($id);

        if(isset($veterinario)){
            $veterinario->nome = $request->get('nome');
            $veterinario->crmv = $request->get('crmv');
            $veterinario->especialidade_id = $request->get('especialidade_id');
            $veterinario->save();
            return json_encode($veterinario);
        }

        return response('Veterinário não encontrado', 404);
    }

    public function destroy($id)
    {
        $veterinario = Veterinario::find($id);

        if(isset($veterinario)){
            $veterinario->delete();
            return response('OK', 200);
        }

        return response('Veterinário não encontrado', 404);
    }

    public function loadJson(){
        $veterinario = Veterinario::all();
        return json_encode($veterinario);
    }
}
