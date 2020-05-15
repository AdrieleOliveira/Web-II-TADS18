<h2>Cadastrar Cliente</h2>

<form action="{{ route('cliente.store') }} " method="POST">
    @csrf
    <a href="{{ route('cliente.index') }}"><h4>Voltar</h4></a>
    <label>Nome: </label>
    <input type="text" name="nome">
    <label>E-mail: </label>
    <input type="text" name="email">
    <input type="submit" value="Salvar">
</form>
