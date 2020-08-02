@extends('templates.main')

@section('logo') {{ asset('img/componente_ico.png') }} @endsection
@section('titulo') Componentes @endsection

@section('conteudo')

    <div class="conteudo">
        <div class='row'>
            <div class='col-sm-12'>
                <button class="btn btn-block botao" onclick="criar()">
                    <b>Cadastrar Novo Componente</b>
                </button>
            </div>
        </div>
        <br>

        <div class="row">
            <x-tablelist :header="['Nome', 'Eventos']" :data="$componentes" :pagina="['componente']"/>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalComponente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formComponente">
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
                                    <label><b>Carga Horária / Nº Aulas - Semanal</b></label>
                                    <input
                                        type="number"
                                        name="carga"
                                        id="carga"
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
                    <h5 class="modal-title"><b>Informações do Componente</b></h5>
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
            $('#modalComponente').modal().find('.modal-title').text("Cadastro de Componente Curricular");
            loadCursos();
            $('#id').val('');
            $('#nome').val('');
            $('#carga').val('');
            $('#curso_id').val('');
            $('#modalComponente').modal('show');
        }

        $('#formComponente').submit(function (event) {
            event.preventDefault();

            if($("#id").val() != '') {
                update($("#id").val() );
            } else {
                insert();
            }
            $("#modalComponente").modal('hide');
        });

        function insert() {
            componente = {
                nome: $("#nome").val(),
                carga_horaria: $("#carga").val(),
                curso_id: $('#curso_id').val(),
            };

            $.post("/api/componente", componente, function (data) {
                novo = JSON.parse(data);
                linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            componente = {
                nome: $("#nome").val(),
                carga_horaria: $("#carga").val(),
                curso_id: $('#curso_id').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/componente/" + id,
                context: this,
                data: componente,
                success: function (data) {
                    linhas = $('#tabela>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });

                    if(e){
                        e[0].cells[1].textContent = componente.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(componente) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td style='display: none'>" + componente.id + "</td>" +
                "<td>" + componente.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + componente.id + ")'><img src=\"{{ asset('img/icons/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + componente.id +")'><img src=\"{{ asset('img/icons/edit.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";

            return linha;
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/componente/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-title').text(data.nome);
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>CARGA HORÁRIA: </b>" + data.carga_horaria + " aula(s) semanais.<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>CURSO: </b>" + data.curso.nome + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $('#modalComponente').modal().find('.modal-title').text("Alteração de Componente Curricular");

            $.getJSON('/api/componente/' + id, function (data) {
                loadCursos(data.curso_id);
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#carga').val(data.carga_horaria);
                $('#curso_id').val(data.curso_id);
                $('#modalComponente').modal('show');
            })
        }

    </script>
@endsection
