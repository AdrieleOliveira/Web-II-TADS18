<h2>Lista de Clientes</h2>
<a href="{{ route('cliente.create') }}"><h4>Novo Cliente</h4></a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>E-MAIL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['nome'] }}</td>
                <td>{{ $item['email'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
