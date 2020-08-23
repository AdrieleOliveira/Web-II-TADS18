<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index(){
        $data = Professor::all();
        return view('professor.index', compact('data'));
    }

    public function store(Request $request){
        try {
            $professor = new Professor([
                'nome' => $request->get('nome'),
                'email' => $request->get('email')
            ]);

            $professor->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($professor);
    }

    public function show($id)
    {
        $professor = Professor::find($id);

        if(isset($professor)){
            return json_encode($professor);
        }

        return response('Professor não encontrado', 404);
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);

        if(isset($professor)){
            $professor->nome = $request->get('nome');
            $professor->email = $request->get('email');
            $professor->save();

            return json_encode($professor);
        }

        return response('Professor não encontrado', 404);
    }
}
