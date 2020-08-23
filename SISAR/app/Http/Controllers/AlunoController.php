<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index(){
        $data = Aluno::with(['curso', 'disciplina'])->get();
        $cursos = Curso::all();
        return view('aluno.index', compact(['data', 'cursos']));
    }

    public function store(Request $request){
        try {
            $curso = Curso::find($request->curso_id);

            if(isset($curso)){
                $aluno = new Aluno();
                $aluno->nome = $request->nome;
                $aluno->email = $request->email;
                $aluno->curso()->associate($curso);
                $aluno->save();

                return json_encode($aluno);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Curso não encontrado', 404);
    }

    public function show($id)
    {
        $aluno = Aluno::where('id', $id)->with('curso')->first();

        if(isset($aluno)){
            return json_encode($aluno);
        }

        return response('Aluno não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id)->first();
        $curso = Curso::find($request->curso_id);

        if(isset($aluno) && isset($curso)){
            $aluno->nome = $request->get('nome');
            $aluno->email = $request->get('email');
            $aluno->curso()->associate($curso);
            $aluno->save();

            return json_encode($aluno);
        }

        return response('Aluno não encontrado', 404);
    }
}
