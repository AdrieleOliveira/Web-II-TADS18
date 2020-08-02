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
                <td>
                    <a nohref style='cursor: pointer' onclick='visualizar("{{ $item->id }}")'><img src="{{ asset('img/icons/info.svg') }}" class='icon'></a>
                    <a nohref style='cursor: pointer' onclick='editar("{{ $item->id }}")'><img src="{{ asset('img/icons/edit.svg') }}" class='icon'></a>
                    @if($pagina[0] == 'disciplina')
                        <a nohref style='cursor: pointer' onclick='pesos("{{ $item->id }}")'><img src="{{ asset('img/icons/peso.svg') }}" class='icon'></a>
                        <a nohref style='cursor: pointer' onclick='conceitos("{{ $item->id }}")'><img src="{{ asset('img/icons/conceito.svg') }}" class='icon'></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
