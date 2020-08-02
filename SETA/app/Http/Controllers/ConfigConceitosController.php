<?php

namespace App\Http\Controllers;

use App\Model\ConfigConceitos;
use App\Model\Disciplina;
use Illuminate\Http\Request;

class ConfigConceitosController extends Controller
{
    public function store(Request $request){

        try {
            $config_conceitos = new ConfigConceitos([
                'conceito_a' => $request->get('conceito_a'),
                'conceito_b' => $request->get('conceito_b'),
                'conceito_c' => $request->get('conceito_c'),
                'conceito_d' => 0,
                'disciplina_id' => $request->get('disciplina_id')

            ]);

            $config_conceitos->save();
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return json_encode($config_conceitos);
    }

    public function show($id)
    {
        try {
            $config_conceitos = ConfigConceitos::where('disciplina_id', $id)->first();

            if (isset($config_conceitos)) {
                $config_conceitos->disciplina = Disciplina::find($config_conceitos->disciplina_id);

                return json_encode($config_conceitos);
            } else {
                return json_encode(false);
            }

        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Configuração de Conceitos não encontrada', 404);
    }

    public function update(Request $request, $id)
    {
        try {
            $config_conceitos = ConfigConceitos::find($id);

            if (isset($config_conceitos)) {
                $config_conceitos->conceito_a = $request->get('conceito_a');
                $config_conceitos->conceito_b = $request->get('conceito_b');
                $config_conceitos->conceito_c = $request->get('conceito_c');
                $config_conceitos->conceito_d = 0;
                $config_conceitos->disciplina_id = $request->get('disciplina_id');
                $config_conceitos->save();

                return json_encode($config_conceitos);
            }
        } catch (\Exception $e){
            return json_encode($e->getMessage());
        }

        return response('Configuração de conceitos não encontrada', 404);
    }
}
