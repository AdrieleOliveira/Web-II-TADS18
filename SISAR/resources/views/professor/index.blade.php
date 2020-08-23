@extends('templates.main')

@section('logo') {{ asset('img/professor_ico.png') }} @endsection
@section('titulo') Professores @endsection

@section('conteudo')

    <div class="conteudo">
        <div class='row'>
            <div class='col-sm-12'>
                <button class="btn btn-block botao" onclick="criar()">
                    <b>Cadastrar Novo Professor</b>
                </button>
            </div>
        </div>
        <br>

        <?php
            $header = ['Nome', 'E-mail', 'Eventos'];
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
                            <td>{{ $item->email }}</td>
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

    <div class="modal" tabindex="-1" role="dialog" id="modalProfessor">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="form">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Cadastro de Prfessor</b></h5>
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
                                    <label><b>E-mail</b></label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
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
                    <h5 class="modal-title"><b>Informações do Professor</b></h5>
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
            $('#modalProfessor').modal().find('.modal-title').text("Cadastro de Professor");
            $('#id').val('');
            $('#nome').val('');
            $('#email').val('');
            $('#modalProfessor').modal('show');
        }

        $('#form').submit(function (event) {
            event.preventDefault();

            if($("#id").val() !== '') {
                update($("#id").val() );
            } else {
                insert();
            }

            $("#modalProfessor").modal('hide');
        });

        function insert() {
            let professor = {
                nome: $("#nome").val(),
                email: $('#email').val()
            };

            $.post("/api/professor", professor, function (data) {
                let novo = JSON.parse(data);
                let linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            let professor = {
                nome: $("#nome").val(),
                email: $('#email').val()
            };

            $.ajax({
                type: "PUT",
                url: "/api/professor/" + id,
                context: this,
                data: professor,
                success: function (data) {
                    let linhas = $('#tabela>tbody>tr');
                    let e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent === id;
                    });

                    if(e){
                        e[0].cells[1].textContent = professor.nome;
                        e[0].cells[2].textContent = professor.email;
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
                "<td>" + item.email + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + item.id + ")'><img src=\"{{ asset('img/icons/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + item.id + ")'><img src=\"{{ asset('img/icons/edit.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/professor/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-title').text(data.nome);
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>NOME: </b>" + data.nome + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>E-MAIL: </b>" + data.email + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $('#modalProfessor').modal().find('.modal-title').text("Alteração de Professor");

            $.getJSON('/api/professor/' + id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#email').val(data.email);
                $('#modalProfessor').modal('show');
            })
        }

    </script>
@endsection

