<?php

namespace App\Http\Controllers;

use App\Model\ComponenteCurricular;
use App\Model\Disciplina;
use App\Model\Turma;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index(){
        $disciplinas = Disciplina::all();
        return view('disciplina.index', compact('disciplinas'));
    }

    public function store(Request $request){

        try {
            $disciplina = new Disciplina([
                'nome' => $request->get('nome'),
                'numero_bimestres' => $request->get('bimestres'),
                'componente_curricular_id' => $request->get('componente_id'),
                'turma_id' => $request->get('turma_id')
            ]);

            $disciplina->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($disciplina);
    }

    public function show($id)
    {
        try {
            $disciplina = Disciplina::find($id);

            if (isset($disciplina)) {
                $disciplina->turma = Turma::find($disciplina->turma_id);
                $disciplina->componente = ComponenteCurricular::find($disciplina->componente_curricular_id);
                return json_encode($disciplina);
            }

        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Disciplina não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        try {
            $disciplina = Disciplina::find($id);

            if (isset($disciplina)) {
                $disciplina->nome = $request->get('nome');
                $disciplina->numero_bimestres = $request->get('bimestres');
                $disciplina->componente_curricular_id = $request->get('componente_id');
                $disciplina->turma_id = $request->get('turma_id');
                $disciplina->save();

                return json_encode($disciplina);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Disciplina não encontrada', 404);
    }
}
