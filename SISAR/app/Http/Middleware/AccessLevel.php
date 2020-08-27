<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AccessLevel
{

    public function handle($request, Closure $next)
    {
        $nivel = 0;
        $rota = $request->route()->getName();

        $response = $next($request);

        if($rota != "negado") {
            if($rota != "home"){
                if ($nivel == 0) {
                    return redirect('negado');
                } else if($nivel == 1 && ($rota != "curso.index") && $rota != "disciplina.index"){
                    return redirect('negado');
                }
            }
        }

        return $response;
    }
}
