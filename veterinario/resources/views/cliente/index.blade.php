<!-- https://material.io/resources/icons/?icon=delete&style=baseline -->

@extends('templates.main', ['titulo' => "Clientes", 'tag' => "CLI"])

@section('titulo') Clientes @endsection

@section('conteudo')

    <div class='row'>
        <div class='col-sm-6'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Novo Cliente</b>
            </button>
        </div>
        <div class='col-sm-5' style="text-align: center">
            <input type="text" list="clientes" class="form-control" autocomplete="on" placeholder="Buscar">
            <datalist id="clientes">
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
        <x-tablelist :header="['NOME', 'EVENTO']" :data="$clientes" :pagina="['cliente']"/>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalCliente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formCliente">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Novo Cliente</b></h5>
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
                                    <label>E-mail</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <label>Telefone</label>
                                    <input
                                        type="phone"
                                        name="telefone"
                                        id="telefone"
                                        value="{{ old('telefone') }}"
                                        class="form-control"
                                    >
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
                    <h5 class="modal-title"><b>Remover Cliente</b></h5>
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
                    <h5 class="modal-title"><b>Informações do Cliente</b></h5>
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

        function loadClientes() {
            $.getJSON('/api/cliente/load', function (data) {
                for(i  = 0; i < data.length; i++){
                    item = '<option value="' + data[i].nome + '">';
                    $('#clientes').append(item);
                }
            })
        }

        function criar() {
            $('#modalCliente').modal().find('.modal-title').text("Cadastrar Cliente");
            $('#id').val('');
            $('#nome').val('');
            $('#email').val('');
            $('#telefone').val('');
            $('#modalCliente').modal('show');
        }

        $('#formCliente').submit(function (event) {
            event.preventDefault();

            if($("#id").val() != '') {
                update($("#id").val() );
            } else {
                insert();
            }
            $("#modalCliente").modal('hide');
        });

        function insert() {
            cliente = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                telefone: $('#telefone').val(),
            };

            $.post("/api/cliente", cliente, function (data) {
                novoCliente = JSON.parse(data);
                linha = getLin(novoCliente);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            cliente = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                telefone: $('#telefone').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/cliente/" + id,
                context: this,
                data: cliente,
                success: function (data) {
                    linhas = $('#tabela>tbody>tr');
                    e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent == id;
                    });

                    if(e){
                        e[0].cells[1].textContent = cliente.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(cliente) {
            const linha =
                "<tr style='text-align: center'>" +
                    "<td style='display: none'>" + cliente.id + "</td>" +
                    "<td>" + cliente.nome + "</td>" +
                    "<td>" +
                        "<a nohref style='cursor: pointer' onclick='visualizar(" + cliente.id + ")'><img src=\"{{ asset('img/info.svg') }}\" class='icon'></a>" +
                        "<a nohref style='cursor: pointer' onclick='editar(" + cliente.id +")'><img src=\"{{ asset('img/edit.svg') }}\" class='icon'></a>" +
                        "<a nohref style='cursor: pointer' onclick='remover(" + cliente.id + ", \"" + cliente.nome + "\")'><img src=\"{{ asset('img/delete.svg') }}\" class='icon'></a>" +
                    "</td>" +
                "</tr>";

            return linha;
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/cliente/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>Nome: </b>" + data.nome + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>E-mail: </b>" + data.email + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>Telefone: </b>" + data.telefone + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
           $('#modalCliente').modal().find('.modal-title').text("Alterar Cliente");

           $.getJSON('/api/cliente/' + id, function (data) {
               $('#id').val(data.id);
               $('#nome').val(data.nome);
               $('#email').val(data.email);
               $('#telefone').val(data.telefone);
               $('#modalCliente').modal('show');
           })
        }

        function remover(id, nome) {
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Desenha remover o cliente '" + nome + "'?");
            $('#id_remove').val(id);
            $('#modalRemove').modal('show');
        }

        function remove() {
            const id = $('#id_remove').val();

            $.ajax({
                type: "DELETE",
                url: "/api/cliente/" + id,
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
            loadClientes();
        })

    </script>
@endsection
