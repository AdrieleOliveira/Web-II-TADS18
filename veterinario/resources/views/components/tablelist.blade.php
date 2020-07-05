<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped'>
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
                <td>{{ $item['nome'] }}</td>
                <td>
                    @if($pagina[0] == "cliente")
                        <a href="{{ route('cliente.show', $item['id']) }}"><img src="{{ asset('img/info.svg') }}" class="icon"></a>
                        <a href="{{ route('cliente.edit', $item['id']) }}"><img src="{{ asset('img/edit.svg') }}" class="icon"></a>
                        <a href="javascript:form_{{$item['id']}}.submit()"><img src="{{ asset('img/delete.svg') }}" class="icon"></a>
                    @endif

                    @if($pagina[0] == "especialidade")
                        <a href="{{ route('especialidade.show', $item['id']) }}"><img src="{{ asset('img/info.svg') }}" class="icon"></a>
                        <a href="{{ route('especialidade.edit', $item['id']) }}"><img src="{{ asset('img/edit.svg') }}" class="icon"></a>
                        <a href="javascript:form_{{$item['id']}}.submit()"><img src="{{ asset('img/delete.svg') }}" class="icon"></a>
                    @endif

                    @if($pagina[0] == "veterinario")
                        <a href="{{ route('veterinario.show', $item['id']) }}"><img src="{{ asset('img/info.svg') }}" class="icon"></a>
                        <a href="{{ route('veterinario.edit', $item['id']) }}"><img src="{{ asset('img/edit.svg') }}" class="icon"></a>
                        <a href="javascript:form_{{$item['id']}}.submit()"><img src="{{ asset('img/delete.svg') }}" class="icon"></a>
                    @endif
                </td>
            </tr>
            @if($pagina[0] == "cliente")
                <form action="{{ route('cliente.destroy', $item['id']) }}"
                      method="POST" name="form_{{$item['id']}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endif

            @if($pagina[0] == "especialidade")
                <form action="{{ route('especialidade.destroy', $item['id']) }}"
                      method="POST" name="form_{{$item['id']}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endif

            @if($pagina[0] == "veterinario")
                <form action="{{ route('veterinario.destroy', $item['id']) }}"
                      method="POST" name="form_{{$item['id']}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
