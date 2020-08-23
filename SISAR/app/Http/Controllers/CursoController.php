<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(){
        $cursos = Curso::all();
        return view('curso.index', compact('cursos'));
    }

    public function store(Request $request){
        try {
            $curso = new Curso([
                'nome' => $request->get('nome'),
            ]);

            $curso->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($curso);
    }

    public function show($id)
    {
        $curso = Curso::find($id);

        if(isset($curso)){
            return json_encode($curso);
        }

        return response('Curso não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);

        if(isset($curso)){
            $curso->nome = $request->get('nome');
            $curso->save();

            return json_encode($curso);
        }

        return response('Curso não encontrado', 404);
    }
}
