<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccessLevel
{

    public function handle($request, Closure $next)
    {
//
            $response = $next($request);
//

            if(Auth::check()) {
                $nivel = Auth::user()->level;
                $rota = $request->route()->getName();

                Log::debug('nivel = ' . $nivel);
                Log::debug('rota = ' . $rota);

                if ($rota != "negado") {
                    if ($rota != "home" && $rota != "") {
                        if ($nivel == 0) {
                            return redirect('negado');
                        } else if ($nivel == 1 && ($rota != "curso.index") && $rota != "disciplina.index") {
                            return redirect('negado');
                        }
                    }
                }
            }



        return $response;
    }
}
