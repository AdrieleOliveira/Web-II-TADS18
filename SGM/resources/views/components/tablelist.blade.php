<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class="table table-striped" style="margin-top: 30px">
        <thead>
            <tr style="text-align: center">
                @foreach ($header as $item)
                    <th>{{ $item }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr style="text-align: center">
                    <td>{{ $item['nome'] }}</td>
                    <td>{{ $item['porte'] }}</td>
                    <td>
                        <a href="{{ route('cidade.show', $item['id']) }}"><img src="{{ asset('img/info.svg') }}" class="icon"></a>
                        <a href="{{ route('cidade.edit', $item['id']) }}"><img src="{{ asset('img/edit.svg') }}" class="icon"></a>
                        <a href="javascript:form_{{$item['id']}}.submit()"><img src="{{ asset('img/delete.svg') }}" class="icon"></a>
                    </td>
                </tr>

                <form action="{{ route('cidade.destroy', $item['id']) }}" method="POST" name="form_{{$item['id']}}">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </tbody>
    </table>
</div>
