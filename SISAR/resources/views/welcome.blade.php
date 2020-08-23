@extends('templates.main')

@section('logo') {{ asset('img/home_ico.png') }} @endsection
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
            <a href="{{ route('disciplina.index') }}">
                <img src="{{ asset('img/disciplina_ico.png') }}" >
                <h4><b>Disciplina</b></h4>
            </a>
        </div>

        <div class="item-menu">
            <a href="{{ route('professor.index') }}">
                <img src="{{ asset('img/professor_ico.png') }}" >
                <h4><b>Professor</b></h4>
            </a>
        </div>

        <div class="item-menu">
            <a href="{{ route('aluno.index') }}">
                <img src="{{ asset('img/aluno_ico.png') }}" >
                <h4><b>Aluno</b></h4>
            </a>
        </div>
    </div>
@endsection

