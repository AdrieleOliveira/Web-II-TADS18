@extends('templates.main', ['pagina' => "Inicio"])

@section('logo') {{ asset('img/city.svg') }} @endsection
@section('titulo') Cidade @endsection

@section('conteudo')

    <a  href="{{ route('cidade.index') }}" type="button" class="btn btn-block button" id="button-voltar">
        Voltar
    </a>

    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>ID: </b> {{ $dados['id'] }} </li>
        <li class="list-group-item"><b>Nome: </b> {{ $dados['nome'] }} </li>
        <li class="list-group-item"><b>Porte: </b> {{ $dados['porte'] }} </li>
    </ul>

@endsection
