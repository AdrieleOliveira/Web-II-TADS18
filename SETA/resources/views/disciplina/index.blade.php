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

        <div class="row">
            <x-tablelist :header="['Nome', 'Eventos']" :data="$disciplinas" :pagina="['disciplina']"/>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalDisciplina">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formDisciplina">
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
                                    <label><b>Número de Bimestres</b></label>
                                    <input
                                        type="number"
                                        name="bimestres"
                                        id="bimestres"
                                        class="form-control"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>Componente Curricular</b></label>
                                    <select
                                        class="form-control"
                                        name="componente_id"
                                        id="componente_id"
                                        required
                                    >
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>Turma</b></label>
                                    <select
                                        class="form-control"
                                        name="turma_id"
                                        id="turma_id"
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

    <div class="modal" tabindex="-1" role="dialog" id="modalPesos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formPesos">
                    <div class="modal-header">
                        <h5 class="modal-title"> </h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_peso" class="form-control">
                        <input type="hidden" id="id_peso_disciplina" class="form-control">
                        <div class="form-group">
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>Trabalho</b></label>
                                    <input
                                        type="number"
                                        name="trabalho"
                                        id="trabalho"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>Avaliação</b></label>
                                    <input
                                        type="number"
                                        name="avaliacao"
                                        id="avaliacao"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>1º Bimestre</b></label>
                                    <input
                                        type="number"
                                        name="bimestre_1"
                                        id="bimestre_1"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>2º Bimestre</b></label>
                                    <input
                                        type="number"
                                        name="bimestre_2"
                                        id="bimestre_2"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>3º Bimestre</b></label>
                                    <input
                                        type="number"
                                        name="bimestre_3"
                                        id="bimestre_3"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>4º Bimestre</b></label>
                                    <input
                                        type="number"
                                        name="bimestre_4"
                                        id="bimestre_4"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
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

    <div class="modal" tabindex="-1" role="dialog" id="modalConceitos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formConceitos">
                    <div class="modal-header">
                        <h5 class="modal-title"> </h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_conceito" class="form-control">
                        <input type="hidden" id="id_conceito_disciplina" class="form-control">
                        <div class="form-group">
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>A</b></label>
                                    <input
                                        type="number"
                                        name="conceito_a"
                                        id="conceito_a"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>B</b></label>
                                    <input
                                        type="number"
                                        name="conceito_b"
                                        id="conceito_b"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label><b>C</b></label>
                                    <input
                                        type="number"
                                        name="conceito_c"
                                        id="conceito_c"
                                        class="form-control"
                                        step="any"
                                        required
                                    >
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

        function loadComponente(id) {

            $.getJSON('/api/componente/load', function (data) {
                $('#componente_id').html("");
                $('#componente_id').append('<option> </option>');

                for(i  = 0; i < data.length; i++){

                    if(data[i].id == id){
                        item = '<option value="' + data[i].id + '" selected>' + data[i].nome + '</option>';
                    } else {
                        item = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                    }

                    $('#componente_id').append(item);
                }
            });
        }

        function loadTurma(id) {

            $.getJSON('/api/turma/load', function (data) {
                $('#turma_id').html("");
                $('#turma_id').append('<option> </option>');

                for(i  = 0; i < data.length; i++){

                    if(data[i].id == id){
                        item = '<option value="' + data[i].id + '" selected>' + data[i].abreviatura + '</option>';
                    } else {
                        item = '<option value="' + data[i].id + '">' + data[i].abreviatura + '</option>';
                    }

                    $('#turma_id').append(item);
                }
            });
        }

        function criar() {
            $('#modalDisciplina').modal().find('.modal-title').text("Cadastro de Disciplina");
            loadComponente();
            loadTurma();
            $('#id').val('');
            $('#nome').val('');
            $('#bimestres').val('');
            $('#componente_id').val('');
            $('#turma_id').val('');
            $('#modalDisciplina').modal('show');
        }

        $('#formDisciplina').submit(function (event) {
            event.preventDefault();

            if($("#id").val() != '') {
                update($("#id").val() );
            } else {
                insert();
            }
            $("#modalDisciplina").modal('hide');
        });

        function insert() {
            disciplina = {
                nome: $("#nome").val(),
                bimestres: $("#bimestres").val(),
                componente_id: $('#componente_id').val(),
                turma_id: $('#turma_id').val(),
            };

            $.post("/api/disciplina", disciplina, function (data) {
                novo = JSON.parse(data);
                linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            disciplina = {
                nome: $("#nome").val(),
                bimestres: $("#bimestres").val(),
                componente_id: $('#componente_id').val(),
                turma_id: $('#turma_id').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/disciplina/" + id,
                context: this,
                data: disciplina,
                success: function (data) {
                    linhas = $('#tabela>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });

                    if(e){
                        e[0].cells[1].textContent = disciplina.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(disciplina) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td style='display: none'>" + disciplina.id + "</td>" +
                "<td>" + disciplina.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + disciplina.id + ")'><img src=\"{{ asset('img/icons/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + disciplina.id +")'><img src=\"{{ asset('img/icons/edit.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='pesos(" + disciplina.id + ")'><img src=\"{{ asset('img/icons/peso.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='conceitos(" + disciplina.id + ")'><img src=\"{{ asset('img/icons/conceito.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";

            return linha;
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/disciplina/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-title').text(data.nome);
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>BIMESTRES: </b>" + data.numero_bimestres + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>COMPONENTE CURRICULAR: </b>" + data.componente.nome + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>TURMA: </b>" + data.turma.abreviatura + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $('#modalDisciplina').modal().find('.modal-title').text("Alteração da Disciplina");

            $.getJSON('/api/disciplina/' + id, function (data) {
                loadTurma(data.turma_id);
                loadComponente(data.componente_curricular_id);
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#bimestres').val(data.numero_bimestres);
                $('#componente_id').val(data.componente_curricular_id);
                $('#turma_id').val(data.turma_id);
                $('#modalDisciplina').modal('show');
            })
        }

        function pesos(id) {
            $.getJSON('/api/disciplina/' + id, function (data) {
                $('#modalPesos').modal().find('.modal-title').html("<b>Configuração de Pesos: </b>" + data.nome);
                $('#id_peso_disciplina').val(data.id);

                $.getJSON('/api/configPesos/' + id, function (data) {
                    if(!data) {
                        $('#id_peso').val('');
                        $('#trabalho').val('');
                        $('#avaliacao').val('');
                        $('#bimestre_1').val('');
                        $('#bimestre_2').val('');
                        $('#bimestre_3').val('');
                        $('#bimestre_4').val('');
                    } else {
                        $('#id_peso').val(data.id);
                        $('#trabalho').val(data.trabalho);
                        $('#avaliacao').val(data.avaliacao);
                        $('#bimestre_1').val(data.primeiro_bimestre);
                        $('#bimestre_2').val(data.segundo_bimestre);
                        $('#bimestre_3').val(data.terceiro_bimestre);
                        $('#bimestre_4').val(data.quarto_bimestre);
                    }
                    $('#modalPesos').modal('show');
                });
            });
        }

        $('#formPesos').submit(function (event) {
            event.preventDefault();

            if($("#id_peso").val() != '') {
                updatePeso($("#id_peso").val() );
            } else {
                insertPeso();
            }
            $("#modalPesos").modal('hide');
        });

        function insertPeso() {
            peso = {
                trabalho: retirarPonto($("#trabalho").val()),
                avaliacao: retirarPonto($("#avaliacao").val()),
                primeiro_bimestre: retirarPonto($('#bimestre_1').val()),
                segundo_bimestre: retirarPonto($('#bimestre_2').val()),
                terceiro_bimestre: retirarPonto($('#bimestre_3').val()),
                quarto_bimestre: retirarPonto($('#bimestre_4').val()),
                disciplina_id: retirarPonto($('#id_peso_disciplina').val()),
            };

            $.post("/api/configPesos", peso, function (data) {

            });
        }

        function updatePeso(id) {
            peso = {
                trabalho: retirarPonto($("#trabalho").val()),
                avaliacao: retirarPonto($("#avaliacao").val()),
                primeiro_bimestre: retirarPonto($('#bimestre_1').val()),
                segundo_bimestre: retirarPonto($('#bimestre_2').val()),
                terceiro_bimestre: retirarPonto($('#bimestre_3').val()),
                quarto_bimestre: retirarPonto($('#bimestre_4').val()),
                disciplina_id: retirarPonto($('#id_peso_disciplina').val()),
            };

            $.ajax({
                type: "PUT",
                url: "/api/configPesos/" + id,
                context: this,
                data: peso,
                success: function (data) {

                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function conceitos(id) {
            $.getJSON('/api/disciplina/' + id, function (data) {
                $('#modalConceitos').modal().find('.modal-title').html("<b>Configuração de Conceitos: </b>" + data.nome);
                $('#id_conceito_disciplina').val(data.id);

                $.getJSON('/api/configConceitos/' + id, function (data) {
                    if(!data) {
                        $('#id_conceito').val('');
                        $('#conceito_a').val('');
                        $('#conceito_b').val('');
                        $('#conceito_c').val('');
                    } else {
                        $('#id_conceito').val(data.id);
                        $('#conceito_a').val(data.conceito_a);
                        $('#conceito_b').val(data.conceito_b);
                        $('#conceito_c').val(data.conceito_c);
                    }
                    $('#modalConceitos').modal('show');
                });
            });
        }

        $('#formConceitos').submit(function (event) {
            event.preventDefault();

            if($("#id_conceito").val() != '') {
                updateConceito($("#id_conceito").val() );
            } else {
                insertConceito();
            }
            $("#modalConceitos").modal('hide');
        });

        function insertConceito() {
            conceito = {
                conceito_a: retirarPonto($("#conceito_a").val()),
                conceito_b: retirarPonto($("#conceito_b").val()),
                conceito_c: retirarPonto($('#conceito_c').val()),
                disciplina_id: $('#id_conceito_disciplina').val(),
            };

            $.post("/api/configConceitos", conceito, function (data) {

            });
        }

        function updateConceito(id) {
            conceito = {
                conceito_a: retirarPonto($("#conceito_a").val()),
                conceito_b: retirarPonto($("#conceito_b").val()),
                conceito_c: retirarPonto($('#conceito_c').val()),
                disciplina_id: $('#id_conceito_disciplina').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/configConceitos/" + id,
                context: this,
                data: conceito,
                success: function (data) {

                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function retirarPonto(valor) {
            return valor.replace(',', '.');
        }

    </script>
@endsection
