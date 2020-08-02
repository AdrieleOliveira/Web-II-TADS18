<?php

namespace App\Http\Controllers;

use App\Model\Curso;
use App\Model\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index(){
        $turmas = Turma::all();
        return view('turma.index', compact('turmas'));
    }

    public function store(Request $request){

        try {
            $turma = new Turma([
                'nome' => $request->get('nome'),
                'ano' => $request->get('ano'),
                'abreviatura' => $request->get('abreviatura'),
                'curso_id' => $request->get('curso_id')
            ]);

            $turma->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($turma);
    }

    public function show($id)
    {
        try {
            $turma = Turma::find($id);

           if (isset($turma)) {
                $turma->curso = Curso::find($turma->curso_id);
                return json_encode($turma);
            }

        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Turma não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        try {
            $turma = Turma::find($id);

            if (isset($turma)) {
                $turma->nome = $request->get('nome');
                $turma->ano = $request->get('ano');
                $turma->abreviatura = $request->get('abreviatura');
                $turma->curso_id = $request->get('curso_id');
                $turma->save();

                return json_encode($turma);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Turma não encontrada', 404);
    }

    public function loadJson(){
        $turma = Turma::all();
        return json_encode($turma);
    }
}
