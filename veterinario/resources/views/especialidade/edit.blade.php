

@extends('templates.main', ['titulo' => "Alterar Especialidade", 'tag' => "ESP"])

@section('titulo') {{$especialidade->nome}} @endsection

@section('conteudo')

    <form action="{{ route('especialidade.update', $especialidade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Nome</label>
                    <input
                        type="text"
                        name="nome"
                        value="{{$especialidade->nome}}"
                        class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                    >

                    @if($errors->has('nome'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class='col-sm-12'>
                    <label>Descrição</label>
                    <textarea
                        name="descricao"
                        class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}"
                    >{{$especialidade->descricao}}</textarea>

                    @if($errors->has('descricao'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descricao') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class='row' style="margin-top:20px">
                <div class='col-sm-4'>
                    <a href="{{route('especialidade.index')}}" class="btn btn-danger btn-block"><b>Cancelar / Voltar</b></a>
                </div>
                <div class='col-sm-8'>
                    <button type="submit" class="btn btn-success btn-block"><b>Confirmar / Salvar</b></button>
                </div>
            </div>
        </div>
    </form>

@endsection
