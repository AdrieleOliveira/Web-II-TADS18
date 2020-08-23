@extends('templates.main')

@section('logo') {{ asset('img/disciplina_ico.png') }} @endsection
@section('titulo') Disciplinas @endsection

@section('conteudo')

    <div class="conteudo">
        <div class='row'>
            <div class='col-sm-12'>
                <button class="btn btn-block botao" onclick="criar()">
                    <b>Cadastrar Nova Disciplina</b>
                </button>
            </div>
        </div>
        <br>

        <?php
        $header = ['Nome', 'Curso', 'Professor', 'Eventos'];
        ?>

        <div class="row">
            <div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
                <table class='table table-striped' id="tabela">
                    <thead>
                    <tr style="text-align: center">
                        @foreach ($header as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr style="text-align: center">
                            <td style="display: none">{{ $item->id }}</td>
                            <td>{{ $item->nome }}</td>
                            <td>{{ $item->curso->nome }}</td>
                            <td>{{ $item->professor->nome }}</td>
                            <td>
                                <a nohref style='cursor: pointer' onclick='visualizar("{{ $item->id }}")'><img src="{{ asset('img/icons/info.svg') }}" class='icon'></a>
                                <a nohref style='cursor: pointer' onclick='editar("{{ $item->id }}")'><img src="{{ asset('img/icons/edit.svg') }}" class='icon'></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalDisciplina">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Cadastro de Desciplina</b></h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <label><b>Nome</b></label>
                                    <input
                                        type="text"
                                        name="nome"
                                        id="nome"
                                        class="form-control"
                                        required
                                    >
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <label><b>Curso</b></label>
                                    <select
                                        name="curso"
                                        id="curso"
                                        class="form-control"
                                        required
                                    >
                                        <option value="0"></option>
                                        @foreach($cursos as $curso)
                                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <label><b>Professor</b></label>
                                    <select
                                        name="professor"
                                        id="professor"
                                        class="form-control"
                                        required
                                    >
                                        <option value="0"></option>
                                        @foreach($professores as $professor)
                                            <option value="{{$professor->id}}">{{$professor->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-salvar">Salvar</button>
                        <button type="cancel" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Informações da Disciplina</b></h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="cancel" class="btn btn-success" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        function criar() {
            $('#modalDisciplina').modal().find('.modal-title').text("Cadastro de Disciplina");
            $('#id').val('');
            $('#nome').val('');
            $('#curso').val(0);
            $('#professor').val(0);
            $('#modalDisciplina').modal('show');
        }

        $('#form').submit(function (event) {
            event.preventDefault();

            if($("#id").val() !== '') {
                update($("#id").val() );
            } else {
                insert();
            }

            $("#modalDisciplina").modal('hide');
        });

        function insert() {
            let disciplina = {
                nome: $("#nome").val(),
                curso_id: $('#curso').val(),
                professor_id: $('#professor').val()
            };

            $.post("/api/disciplina", disciplina, function (data) {
                let novo = JSON.parse(data);
                let linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            let disciplina = {
                nome: $("#nome").val(),
                curso_id: $('#curso').val(),
                professor_id: $('#professor').val()
            };

            $.ajax({
                type: "PUT",
                url: "/api/disciplina/" + id,
                context: this,
                data: disciplina,
                success: function (data) {
                    let linhas = $('#tabela>tbody>tr');
                    let e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent === id;
                    });

                    if(e){

                        const json = JSON.parse(data);
                        e[0].cells[1].textContent = disciplina.nome;
                        e[0].cells[2].textContent = json.curso.nome;
                        e[0].cells[3].textContent = json.professor.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(item) {
            return "<tr style='text-align: center'>" +
                "<td style='display: none'>" + item.id + "</td>" +
                "<td>" + item.nome + "</td>" +
                "<td>" + item.curso.nome + "</td>" +
                "<td>" + item.professor.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + item.id + ")'><img src=\"{{ asset('img/icons/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + item.id + ")'><img src=\"{{ asset('img/icons/edit.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/disciplina/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-title').text(data.nome);
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>NOME: </b>" + data.nome + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>CURSO: </b>" + data.curso.nome + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>PROFESSOR: </b>" + data.professor.nome + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $.getJSON('/api/disciplina/' + id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#curso').val(data.curso_id);
                $('#professor').val(data.professor_id);
                $('#modalDisciplina').modal().find('.modal-title').text("Alteração de Disciplina");
                $('#modalDisciplina').modal('show');

            })


        }

    </script>
@endsection

