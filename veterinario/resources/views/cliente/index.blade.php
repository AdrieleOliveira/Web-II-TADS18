<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Clientes", 'tag' => "CLI"])

@section('titulo') Clientes @endsection

@section('conteudo')

    <div class='row'>
        <div class='col-sm-6'>
            <a  href="{{ route('cliente.create') }}" type="button" class="btn btn-primary btn-block">
                <b>Cadastrar Novo Cliente</b>
            </a>
        </div>
        <div class='col-sm-5' style="text-align: center">
            <input type="text" list="clientes" class="form-control" autocomplete="on" placeholder="Buscar">
            <datalist id="clientes">
                @foreach ($clientes as $item)
                    <option value="{{ $item['nome'] }}">
                @endforeach
            </datalist>
        </div>
        <div class='col-sm-1' style="text-align: center">
            <button type="button" class="btn btn-default btn-block">
                <img src="{{ asset('img/search.svg') }}" class="icon">
            </button>
        </div>
    </div>
    <br>
    <div class="row">
        <x-tablelist :header="['NOME', 'EVENTO']" :data="$clientes" :pagina="['cliente']"/>
    </div>

@endsection

