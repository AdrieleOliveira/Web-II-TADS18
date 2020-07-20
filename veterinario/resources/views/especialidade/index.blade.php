<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Especialidades", 'tag' => "ESP"])

@section('titulo') Especialidades @endsection

@section('conteudo')

    <div class='row'>
        <div class='col-sm-6'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Nova Especialidade</b>
            </button>
        </div>
        <div class='col-sm-5' style="text-align: center">
            <input type="text" list="especialidades" class="form-control" autocomplete="on" placeholder="Buscar">
            <datalist id="especialidades">
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
        <x-tablelist :header="['NOME', 'EVENTO']" :data="$especialidades" :pagina="['especialidade']"/>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalEspecialidade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formEspecialidade">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Nova Especialidade</b></h5>
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
                                        value="{{ old('nome') }}"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label>Descrição</label>
                                    <textarea
                                        name="descricao"
                                        id="descricao"
                                        class="form-control"
                                    > {{ old('descricao') }}</textarea>
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
                    <h5 class="modal-title"><b>Remover Especialidade</b></h5>
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
                    <h5 class="modal-title"><b>Informações da Especialidade</b></h5>
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

        function loadEspecialidades() {
            $.getJSON('/api/especialidade/load', function (data) {
                for(i  = 0; i < data.length; i++){
                    item = '<option value="' + data[i].nome + '">';
                    $('#especialidades').append(item);
                }
            })
        }

        function criar() {
            $('#modalEspecialidade').modal().find('.modal-title').text("Cadastrar Especialidade");
            $('#id').val('');
            $('#nome').val('');
            $('#descricao').val('');
            $('#modalEspecialidade').modal('show');
        }

        $('#formEspecialidade').submit(function (event) {
            event.preventDefault();

            if($("#id").val() != '') {
                update($("#id").val() );
            } else {
                insert();
            }
            $("#modalEspecialidade").modal('hide');
        });

        function insert() {
            especialidade = {
                nome: $("#nome").val(),
                descricao: $('#descricao').val(),
            };

            $.post("/api/especialidade", especialidade, function (data) {
                novo = JSON.parse(data);
                linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            especialidade = {
                nome: $("#nome").val(),
                descricao: $('#descricao').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/especialidade/" + id,
                context: this,
                data: especialidade,
                success: function (data) {
                    linhas = $('#tabela>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });

                    if(e){
                        e[0].cells[1].textContent = especialidade.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(especialidade) {
            const linha =
                "<tr style='text-align: center'>" +
                "<td style='display: none'>" + especialidade.id + "</td>" +
                "<td>" + especialidade.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + especialidade.id + ")'><img src=\"{{ asset('img/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + especialidade.id +")'><img src=\"{{ asset('img/edit.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='remover(" + especialidade.id + ", \"" + especialidade.nome + "\")'><img src=\"{{ asset('img/delete.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";

            return linha;
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/especialidade/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>Nome: </b>" + data.nome + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>Descrição: </b>" + data.descricao + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $('#modalEspecialidade').modal().find('.modal-title').text("Alterar Especialidade");

            $.getJSON('/api/especialidade/' + id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#descricao').val(data.descricao);
                $('#modalEspecialidade').modal('show');
            })
        }

        function remover(id, nome) {
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Desenha remover a especialidade '" + nome + "'?");
            $('#id_remove').val(id);
            $('#modalRemove').modal('show');
        }

        function remove() {
            const id = $('#id_remove').val();

            $.ajax({
                type: "DELETE",
                url: "/api/especialidade/" + id,
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
            loadEspecialidades();
        })

    </script>
@endsection

