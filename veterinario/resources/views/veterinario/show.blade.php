@extends('templates.main', ['titulo' => "Informações do Veterinário", 'tag' => "VET"])

@section('titulo') {{ $veterinario->nome }} @endsection

@section('conteudo')

    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>ID:</b> {{ $veterinario->id }}</li>
        <li class="list-group-item"><b>Nome:</b> {{ $veterinario->nome }}</li>
        <li class="list-group-item"><b>CRMV:</b> {{ $veterinario->crmv }}</li>
        <li class="list-group-item"><b>Especialidade:</b> {{ $veterinario->especialidade->nome }}</li>
        <li class="list-group-item">
            <a href="{{route('veterinario.index')}}" class="btn btn-secondary btn-block"><b>Voltar</b></a>
        </li>
    </ul>
@endsection
