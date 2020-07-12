@extends('templates.main', ['titulo' => "Cadastrar Veterinário", 'tag' => "VET"])

@section('titulo') Novo Veterinário @endsection

@section('conteudo')

    <form action="{{ route('veterinario.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Nome</label>
                    <input
                        type="text"
                        name="nome"
                        class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                        value="{{ old('nome') }}"
                    >

                    @if($errors->has('nome'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class='col-sm-6'>
                    <label>CRMV</label>
                    <input
                        type="text"
                        name="crmv"
                        class="form-control {{ $errors->has('crmv') ? 'is-invalid' : '' }}"
                        value="{{ old('crmv') }}"
                    >

                    @if($errors->has('crmv'))
                        <div class="invalid-feedback">
                            {{ $errors->first('crmv') }}
                        </div>
                    @endif
                </div>

                <div class='col-sm-6'>
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade_id">
                        <option></option>
                        @foreach($especialidades as $item)
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class='row' style="margin-top:20px">
                <div class='col-sm-4'>
                    <a href="{{route('veterinario.index')}}" class="btn btn-danger btn-block"><b>Cancelar / Voltar</b></a>
                </div>
                <div class='col-sm-8'>
                    <button type="submit" class="btn btn-success btn-block"><b>Confirmar / Salvar</b></button>
                </div>
            </div>
        </div>
    </form>

@endsection
