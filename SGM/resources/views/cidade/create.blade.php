@extends('templates.main', ['pagina' => "Inicio"])

@section('logo') {{ asset('img/new.svg') }} @endsection
@section('titulo') Cadastrar @endsection

@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('cidade.store') }}" method="POST" style="margin-top: 30px">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-block button" id="button-confirmar">
                                Confirmar / Cadastrar
                            </button>
                        </div>

                        <div class="col-sm-2">
                            <a  href="{{ route('cidade.index') }}" type="button" class="btn btn-block button" id="button-voltar">
                                Voltar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-sm-8">
                            <label class="titulo-label">Nome</label>
                            <input type="text" class="form-control" name="nome">
                        </div>

                        <div class="col-sm-4">
                            <label class="titulo-label">Porte</label>
                            <select class="form-control" name="porte">
                                <option value=""></option>
                                <option value="Pequeno">Pequeno</option>
                                <option value="Médio">Médio</option>
                                <option value="Grande">Grande</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
