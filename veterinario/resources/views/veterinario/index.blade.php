<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Veterinários", 'tag' => "VET"])

@section('titulo') Veterinários @endsection

@section('conteudo')

    <div class='row'>
        <div class='col-sm-6'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Novo Veterinário</b>
            </button>
        </div>
        <div class='col-sm-5' style="text-align: center">
            <input type="text" list="veterinarios" class="form-control" autocomplete="on" placeholder="Buscar">
            <datalist id="veterinarios">
            </datalist>
        </div>
        <div class='col-sm-1' style="text-align: center">
            <button type="button" class="btn btn-default btn-block">
                <img src="{{ asset('img/search.svg') }}" class="icon">
            </button>
        </div>
    </div>
    <br>
    <div class="row">
        <x-tablelist :header="['NOME', 'EVENTO']" :data="$veterinarios" :pagina="['veterinario']"/>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalVeterinario">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formVeterinario">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Novo Veterinário</b></h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <label>Nome</label>
                                    <input
                                        type="text"
                                        name="nome"
                                        id="nome"
                                        class="form-control"
                                        value="{{ old('nome') }}"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label>CRMV</label>
                                    <input
                                        type="text"
                                        name="crmv"
                                        id="crmv"
                                        class="form-control"
                                        value="{{ old('crmv') }}"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label>Especialidade</label>
                                    <select class="form-control" name="especialidade_id" id="especialidades_id">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalRemove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" id="id_remove" class="form-control">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Remover Veterinário</b></h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" onClick="remove()"><b>Sim, remover</b></button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Informações do Veterinário</b></h5>
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

        function loadVeterinarios() {
            $.getJSON('/api/veterinario/load', function (data) {
                for(i  = 0; i < data.length; i++){
                    item = '<option value="' + data[i].nome + '">';
                    $('#veterinarios').append(item);
                }
            });
        }

        function loadEspecialidades(id) {
            $.getJSON('/api/especialidade/load', function (data) {

                $('#especialidades_id').html("");
                for(i  = 0; i < data.length; i++){

                    if(data[i].id == id){
                        item = '<option value="' + data[i].id + '" selected>' + data[i].nome + '</option>';
                    } else {
                        item = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                    }

                    $('#especialidades_id').append(item);
                }
            });
        }

        function criar() {
            $('#modalVeterinario').modal().find('.modal-title').text("Cadastrar Veterinário");
            loadEspecialidades();
            $('#id').val('');
            $('#nome').val('');
            $('#crmv').val('');
            $('#especialidades_id').val('');
            $('#modalVeterinario').modal('show');
        }

        $('#formVeterinario').submit(function (event) {
            event.preventDefault();

            if($("#id").val() != '') {
                update($("#id").val() );
            } else {
                insert();
            }
            $("#modalVeterinario").modal('hide');
        });

        function insert() {
            veterinario = {
                nome: $("#nome").val(),
                crmv: $("#crmv").val(),
                especialidade_id: $('#especialidades_id').val(),
            };

            $.post("/api/veterinario", veterinario, function (data) {
                novo = JSON.parse(data);
                linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            veterinario = {
                nome: $("#nome").val(),
                crmv: $("#crmv").val(),
                especialidade_id: $('#especialidades_id').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/veterinario/" + id,
                context: this,
                data: veterinario,
                success: function (data) {
                    linhas = $('#tabela>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });

                    if(e){
                        e[0].cells[1].textContent = veterinario.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(veterinario) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td style='display: none'>" + veterinario.id + "</td>" +
                "<td>" + veterinario.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + veterinario.id + ")'><img src=\"{{ asset('img/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + veterinario.id +")'><img src=\"{{ asset('img/edit.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='remover(" + veterinario.id + ", \"" + veterinario.nome + "\")'><img src=\"{{ asset('img/delete.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";

            return linha;
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/veterinario/' + id, function (data) {

                $.getJSON('/api/especialidade/' + data.especialidade_id, function (data_e) {
                    $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                    $('#modalInfo').modal().find('.modal-body').append("<b>Nome: </b>" + data.nome + "<br>");
                    $('#modalInfo').modal().find('.modal-body').append("<b>CRMV: </b>" + data.crmv + "<br>");
                    $('#modalInfo').modal().find('.modal-body').append("<b>Especialidade: </b>" + data_e.nome + "<br>");
                    $('#modalInfo').modal('show');
                });


            })
        }

        function editar(id) {
            $('#modalVeterinario').modal().find('.modal-title').text("Alterar Veterinário");

            $.getJSON('/api/veterinario/' + id, function (data) {
                loadEspecialidades(data.especialidade_id);
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#crmv').val(data.crmv);
                $('#especialidades_id').val(data.especialidade_id);
                $('#modalVeterinario').modal('show');
            })
        }

        function remover(id, nome) {
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Desenha remover o veterinário '" + nome + "'?");
            $('#id_remove').val(id);
            $('#modalRemove').modal('show');
        }

        function remove() {
            const id = $('#id_remove').val();

            $.ajax({
                type: "DELETE",
                url: "/api/veterinario/" + id,
                context: this,
                success: function () {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function (i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });
                    if (e){
                        e.remove();
                    }
                },
                error: function (error) {
                    alert('ERRO - DELETE');
                    console.log(error);
                }
            });

            $('#modalRemove').modal('hide');
        }

        $(function () {
            loadVeterinarios();
        })

    </script>
@endsection

