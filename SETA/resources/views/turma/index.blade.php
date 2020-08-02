@extends('templates.main')

@section('logo') {{ asset('img/turma_ico.png') }} @endsection
@section('titulo') Turmas @endsection

@section('conteudo')

    <div class="conteudo">
        <div class='row'>
            <div class='col-sm-12'>
                <button class="btn btn-block botao" onclick="criar()">
                    <b>Cadastrar Nova Turma</b>
                </button>
            </div>
        </div>
        <br>

        <div class="row">
            <x-tablelist :header="['Nome', 'Eventos']" :data="$turmas" :pagina="['componente']"/>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalTurma">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formTurma">
                    <div class="modal-header">
                        <h5 class="modal-title"> </h5>
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
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>Ano</b></label>
                                    <input
                                        type="number"
                                        name="ano"
                                        id="ano"
                                        class="form-control"
                                        required
                                    >
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-sm-12'>
                                    <label><b>Abreviatura</b></label>
                                    <input
                                        type="text"
                                        name="abreviatura"
                                        id="abreviatura"
                                        class="form-control"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>Curso</b></label>
                                    <select
                                        class="form-control"
                                        name="curso_id"
                                        id="curso_id"
                                        required
                                    >
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
                    <h5 class="modal-title"><b>Informações da Turma</b></h5>
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

        function loadCursos(id) {

            $.getJSON('/api/curso/load', function (data) {
                $('#curso_id').html("");
                $('#curso_id').append('<option> </option>');

                for(i  = 0; i < data.length; i++){

                    if(data[i].id == id){
                        item = '<option value="' + data[i].id + '" selected>' + data[i].nome + '</option>';
                    } else {
                        item = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                    }

                    $('#curso_id').append(item);
                }
            });
        }

        function criar() {
            $('#modalTurma').modal().find('.modal-title').text("Cadastro de Turma");
            loadCursos();
            $('#id').val('');
            $('#nome').val('');
            $('#ano').val('');
            $('#abreviatura').val('');
            $('#curso_id').val('');
            $('#modalTurma').modal('show');
        }

        $('#formTurma').submit(function (event) {
            event.preventDefault();

            if($("#id").val() != '') {
                update($("#id").val() );
            } else {
                insert();
            }
            $("#modalTurma").modal('hide');
        });

        function insert() {
            turma = {
                nome: $("#nome").val(),
                ano: $("#ano").val(),
                abreviatura: $('#abreviatura').val(),
                curso_id: $('#curso_id').val(),
            };

            $.post("/api/turma", turma, function (data) {
                novo = JSON.parse(data);
                linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            turma = {
                nome: $("#nome").val(),
                ano: $("#ano").val(),
                abreviatura: $('#abreviatura').val(),
                curso_id: $('#curso_id').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/turma/" + id,
                context: this,
                data: turma,
                success: function (data) {
                    linhas = $('#tabela>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });

                    if(e){
                        e[0].cells[1].textContent = turma.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(turma) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td style='display: none'>" + turma.id + "</td>" +
                "<td>" + turma.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + turma.id + ")'><img src=\"{{ asset('img/icons/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + turma.id +")'><img src=\"{{ asset('img/icons/edit.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";

            return linha;
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/turma/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-title').text(data.nome);
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>ANO: </b>" + data.ano + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>ABREVIATURA: </b>" + data.abreviatura + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>CURSO: </b>" + data.curso.nome + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $('#modalTurma').modal().find('.modal-title').text("Alteração da Turma");

            $.getJSON('/api/turma/' + id, function (data) {
                loadCursos(data.curso_id);
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#ano').val(data.ano);
                $('#abreviatura').val(data.abreviatura);
                $('#curso_id').val(data.curso_id);
                $('#modalTurma').modal('show');
            })
        }

    </script>
@endsection
