<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NegadoController extends Controller
{
    public function index(){
        return view('negado.index');
    }
}
