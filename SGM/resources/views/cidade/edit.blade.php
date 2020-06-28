@extends('templates.main', ['pagina' => "Inicio"])

@section('logo') {{ asset('img/editar.svg') }} @endsection
@section('titulo') Editar @endsection

@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('cidade.update', $dados['id']) }}" method="POST" style="margin-top: 30px">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-block button" id="button-confirmar">
                                Confirmar / Salvar
                            </button>
                        </div>

                        <div class="col-sm-3">
                            <a  href="{{ route('cidade.index') }}" type="button" class="btn btn-block button" id="button-voltar">
                                Cancelar / Voltar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-sm-8">
                            <label class="titulo-label">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ $dados['nome'] }}">
                        </div>

                        <div class="col-sm-4">
                            <label class="titulo-label">Porte</label>
                            <select class="form-control" name="porte">
                                <option value=""></option>
                                <option value="Pequeno"
                                    @if($dados['porte'] == 'Pequeno')
                                        selected
                                    @endif
                                >Pequeno</option>
                                <option value="Médio"
                                    @if($dados['porte'] == 'Médio')
                                        selected
                                    @endif
                                >Médio</option>
                                <option value="Grande"
                                    @if($dados['porte'] == 'Grande')
                                        selected
                                    @endif
                                >Grande</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
