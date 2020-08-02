<?php

namespace App\Http\Controllers;

use App\Model\ComponenteCurricular;
use App\Model\Curso;
use Illuminate\Http\Request;

class ComponenteCurricularController extends Controller
{
    public function index(){
        $componentes = ComponenteCurricular::all();
        return view('componente.index', compact('componentes'));
    }

    public function store(Request $request){
        try {
            $componente = new ComponenteCurricular([
                'nome' => $request->get('nome'),
                'carga_horaria' => $request->get('carga_horaria'),
                'curso_id' => $request->get('curso_id')
            ]);

            $componente->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($componente);
    }

    public function show($id)
    {
        $componente = ComponenteCurricular::find($id);

        if(isset($componente)){
            $componente->curso = Curso::find($componente->curso_id);
            return json_encode($componente);
        }

        return response('Componente curricular não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        try {
            $componente = ComponenteCurricular::find($id);

            if (isset($componente)) {
                $componente->nome = $request->get('nome');
                $componente->carga_horaria = $request->get('carga_horaria');
                $componente->curso_id = $request->get('curso_id');
                $componente->save();

                return json_encode($componente);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Componente Curricular não encontrado', 404);
    }

    public function loadJson(){
        $componente = ComponenteCurricular::all();
        return json_encode($componente);
    }
}
