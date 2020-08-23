@extends('templates.main')

@section('logo') {{ asset('img/conceito_ico.png') }} @endsection
@section('titulo') Matrículas @endsection

@section('conteudo')

    <div class="conteudo">
        <div class='row' style="padding: 0">
            <div class='col-sm-3' style="padding-left: 0">
                <a href="{{route('aluno.index')}}" class="btn btn-block botao" style="background-color: gray; border-color: gray" id="voltar">
                    <b>Voltar</b>
                </a>
            </div>
            <div class='col-sm-6' style="background-color: #ffc3a0; padding: 8px 5px">
                <img src="{{asset('img/curso_ico.png')}}" style="width: 20px;">
                <b>{{$aluno->curso->nome}}</b>
            </div>
            <div class='col-sm-3' style="background-color: #ffc3a0; padding: 8px 5px">
                <img src="{{asset('img/aluno_ico.png')}}" style="width: 20px;">
                <b>{{$aluno->nome}}</b>
            </div>
        </div>
        <br>

        <div class="panel" style="background-color: #ffc3a0; display: flex; flex-direction: column; align-items: center; padding: 8px 0">
            <img src="{{asset('img/conceito_ico.png')}}" width="30px">
            <b>Matrículas do Aluno</b>
        </div>

        <div class="disciplinas">
            <form id="form">
                <input type="hidden" id="id" value="{{$aluno->id}}">
                @foreach($disciplinas as $disciplina)
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="checkbox" name="disciplina" value="{{$disciplina->id}}"

                                    @foreach($matricula as $m)
                                        @if($m->disciplina_id == $disciplina->id)
                                            checked
                                        @endif
                                    @endforeach
                                >
                                    <span style="text-transform: uppercase; padding-left: 5px">{{$disciplina->nome}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="modal-footer">
                    <button type="submit" class="btn btn-salvar" style="width: 100%">Confirmar Matrícula</button>
                </div>
            </form>
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

        $('#form').submit(function (event) {
            event.preventDefault();
            const id = $("#id").val();

            remover(id);
        });

        function insert(id) {
            let disciplinas = $('input[name="disciplina"]:checked');

            Array.prototype.forEach.call(disciplinas, function (item) {
                let matricula = {
                    aluno_id: id,
                    disciplina_id: item.value
                }

                $.post("/api/matricula", matricula, function (data) {

                });
            });

            const button = document.getElementById('voltar');
            button.click();
        }

        function remover(id) {

            $.ajax({
                type: "DELETE",
                url: "/api/matricula/" + id,
                context: this,
                success: function () {
                    insert(id);
                },
                error: function (error) {
                    alert('ERRO - DELETE');
                    console.log(error);
                }
            });
        }
    </script>
@endsection

