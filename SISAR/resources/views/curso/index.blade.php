@extends('templates.main')

@section('logo') {{ asset('img/curso_ico.png') }} @endsection
@section('titulo') Cursos @endsection

@section('conteudo')

    <div class="conteudo">
        <div class='row'>
            <div class='col-sm-12'>
                <button class="btn btn-block botao" onclick="criar()">
                    <b>Cadastrar Novo Curso</b>
                </button>
            </div>
        </div>
        <br>

        <div class="row">
            <x-tablelist :header="['Nome', 'Eventos']" :data="$cursos" :pagina="['curso']"/>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modalCurso">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formCurso">
                    <div class="modal-header">
                        <h5 class="modal-title"><b>Cadastro de Curso</b></h5>
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
                    <h5 class="modal-title"><b>Informações do Curso</b></h5>
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
            $('#modalCurso').modal().find('.modal-title').text("Cadastro de Curso");
            $('#id').val('');
            $('#nome').val('');
            $('#modalCurso').modal('show');
        }

        $('#formCurso').submit(function (event) {
            event.preventDefault();

            if($("#id").val() !== '') {
                update($("#id").val() );
            } else {
                insert();
            }

            $("#modalCurso").modal('hide');
        });

        function insert() {
            let curso = {
                nome: $("#nome").val(),
            };

            $.post("/api/curso", curso, function (data) {
                let novo = JSON.parse(data);
                let linha = getLin(novo);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            let curso = {
                nome: $("#nome").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/curso/" + id,
                context: this,
                data: curso,
                success: function (data) {
                    let linhas = $('#tabela>tbody>tr');
                    let e = linhas.filter(function (i, e) {
                        return e.cells[0].textContent === id;
                    });

                    if(e){
                        e[0].cells[1].textContent = curso.nome;
                    }
                },
                error: function (error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(curso) {
            return "<tr style='text-align: center'>" +
                "<td style='display: none'>" + curso.id + "</td>" +
                "<td>" + curso.nome + "</td>" +
                "<td>" +
                "<a nohref style='cursor: pointer' onclick='visualizar(" + curso.id + ")'><img src=\"{{ asset('img/icons/info.svg') }}\" class='icon'></a>" +
                "<a nohref style='cursor: pointer' onclick='editar(" + curso.id + ")'><img src=\"{{ asset('img/icons/edit.svg') }}\" class='icon'></a>" +
                "</td>" +
                "</tr>";
        }

        function visualizar(id) {
            $('#modalInfo').modal().find(".modal-body").html("");

            $.getJSON('/api/curso/' + id, function (data) {
                $('#modalInfo').modal().find('.modal-title').text(data.nome);
                $('#modalInfo').modal().find('.modal-body').append("<b>ID: </b>" + data.id + "<br>");
                $('#modalInfo').modal().find('.modal-body').append("<b>NOME: </b>" + data.nome + "<br>");
                $('#modalInfo').modal('show');
            })
        }

        function editar(id) {
            $('#modalCurso').modal().find('.modal-title').text("Alteração de Curso");

            $.getJSON('/api/curso/' + id, function (data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#modalCurso').modal('show');
            })
        }

    </script>
@endsection

