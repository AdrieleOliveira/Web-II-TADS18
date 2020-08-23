<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Disciplina;
use App\Professor;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index(){
        $data = Disciplina::with(['curso', 'professor'])->get();
        $cursos = Curso::all();
        $professores = Professor::all();
        return view('disciplina.index', compact(['data', 'cursos', 'professores']));
    }

    public function store(Request $request){
        try {
            $curso = Curso::find($request->curso_id);
            $professor = Professor::find($request->professor_id);

            if(isset($curso) && isset($professor)){
                $d = new Disciplina();
                $d->nome = $request->nome;
                $d->curso()->associate($curso);
                $d->professor()->associate($professor);
                $d->save();

                return json_encode($d);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Curso ou professor não encontrado', 404);
    }

    public function show($id)
    {
        $disciplia = Disciplina::where('id', $id)->with(['curso', 'professor'])->first();

        if(isset($disciplia)){
            return json_encode($disciplia);
        }

        return response('Disciplina não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);
        $curso = Curso::find($request->curso_id);
        $professor = Professor::find($request->professor_id);

        if(isset($disciplina) && isset($curso) && isset($professor)){
            $disciplina->nome = $request->get('nome');
            $disciplina->curso()->associate($curso);
            $disciplina->professor()->associate($professor);
            $disciplina->save();

            return json_encode($disciplina);
        }

        return response('Disciplina não encontrada', 404);
    }
}
