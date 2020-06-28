@extends('templates.main', ['pagina' => "Inicio"])

@section('logo') {{ asset('img/lista.svg') }} @endsection
@section('titulo') Cidades @endsection

@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <a  href="{{ route('cidade.create') }}" type="button" class="btn btn-block button" id="button-cadastrar">
                Cadastrar Nova Cidade
            </a>
        </div>

        <x-tablelist :header="['CIDADE', 'PORTE', 'EVENTO']" :data="$cidades" />
    </div>

@endsection
