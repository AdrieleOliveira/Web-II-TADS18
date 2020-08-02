<?php

namespace App\Http\Controllers;

use App\Model\ConfigPesos;
use App\Model\Disciplina;
use Illuminate\Http\Request;

class ConfigPesosController extends Controller
{
    public function store(Request $request){

        try {
            $config_pesos = new ConfigPesos([
                'trabalho' => $request->get('trabalho'),
                'avaliacao' => $request->get('avaliacao'),
                'primeiro_bimestre' => $request->get('primeiro_bimestre'),
                'segundo_bimestre' => $request->get('segundo_bimestre'),
                'terceiro_bimestre' => $request->get('terceiro_bimestre'),
                'quarto_bimestre' => $request->get('quarto_bimestre'),
                'disciplina_id' => $request->get('disciplina_id')

            ]);

            $config_pesos->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($config_pesos);
    }

    public function show($id)
    {
        try {
            $config_pesos = ConfigPesos::where('disciplina_id', $id)->first();

            if (isset($config_pesos)) {
                $config_pesos->disciplina = Disciplina::find($config_pesos->disciplina_id);

                return json_encode($config_pesos);
            } else {
                return json_encode(false);
            }

        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Configuração de Pesos não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        try {
            $config_pesos = ConfigPesos::find($id);

            if (isset($config_pesos)) {
                $config_pesos->trabalho = $request->get('trabalho');
                $config_pesos->avaliacao = $request->get('avaliacao');
                $config_pesos->primeiro_bimestre = $request->get('primeiro_bimestre');
                $config_pesos->segundo_bimestre = $request->get('segundo_bimestre');
                $config_pesos->terceiro_bimestre = $request->get('terceiro_bimestre');
                $config_pesos->quarto_bimestre = $request->get('quarto_bimestre');
                $config_pesos->disciplina_id = $request->get('disciplina_id');
                $config_pesos->save();

                return json_encode($config_pesos);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Configuração de pesos não encontrada', 404);
    }
}
