

@extends('templates.main', ['titulo' => "Alterar Veterinário", 'tag' => "VET"])

@section('titulo') {{$veterinario->nome}} @endsection

@section('conteudo')

    <form action="{{ route('veterinario.update', $veterinario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class='row'>
                <div class='col-sm-12'>
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value="{{ $veterinario->nome }}">
                </div>
            </div>
            <div class="row">
                <div class='col-sm-6'>
                    <label>CRMV</label>
                    <input type="text" class="form-control" name="crmv" value="{{ $veterinario->crmv }}">
                </div>

                <div class='col-sm-6'>
                    <label>Especialidade</label>
                    <select class="form-control" name="especialidade_id">
                        <option></option>
                        @foreach($especialidades as $item)
                            <option value="{{ $item->id }}"
                                @if($item->id == $veterinario->especialidade_id )
                                    selected
                                @endif
                            />{{ $item->nome }}</option>
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