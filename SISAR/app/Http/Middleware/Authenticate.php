<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next)
    {
//        $nivel = 1;
//        $rota = $request->route()->getName();
//
        $response = $next($request);
//
//        if($rota != "negado") {
//            if($rota != "home"){
//                if ($nivel == 0) {
//                    return redirect('negado');
//                } else if($nivel == 1 && ($rota != "curso.index") && $rota != "disciplina.index"){
//                    return redirect('negado');
//                }
//            }
//        }

        return $response;
    }
}
