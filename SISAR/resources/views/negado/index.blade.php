@extends('templates.main')

@section('logo') {{ asset('img/restrito.png') }} @endsection
@section('titulo') Restrito @endsection

@section('conteudo')
    <div class="conteudo">
        <div class='row' style="display: flex; flex-direction: column; align-items: center">
            <h1><b>Acesso Restrito</b></h1>
            <img src="{{asset('./img/restrito.png')}}" />
        </div>
        <br>
    </div>
@endsection

