@extends('templates.main')

@section('logo') {{ asset('img/menu_ico.png') }} @endsection
@section('titulo') Menu @endsection

@section('conteudo')
    <div class="menu">
        <div class="item-menu">
            <a href="{{ route('curso.index') }}">
                <img src="{{ asset('img/curso_ico.png') }}" >
                <h4><b>Curso</b></h4>
            </a>
        </div>

        <div class="item-menu">
            <a href="{{ route('componente.index') }}">
                <img src="{{ asset('img/componente_ico.png') }}" >
                <h4><b>Componente</b></h4>
            </a>
        </div>

        <div class="item-menu">
            <a href="{{ route('turma.index') }}">
                <img src="{{ asset('img/turma_ico.png') }}" >
                <h4><b>Turma</b></h4>
            </a>
        </div>

        <div class="item-menu">
            <a href="{{ route('disciplina.index') }}">
                <img src="{{ asset('img/disciplina_ico.png') }}" >
                <h4><b>Disciplina</b></h4>
            </a>
        </div>
    </div>
@endsection

