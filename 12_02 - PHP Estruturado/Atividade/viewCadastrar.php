<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include_once ("controle.php");

    if(!empty($_POST["form_submit"])){
        rotasCadastrar($_POST);
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cadastrar Pessoa</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

<div class="container">
    <h1>Cadastrar Pessoa Física</h1>
    <hr>

    <div>
        <form class="form" method="post" action="viewCadastrar.php">
            <input type="hidden" name="form_submit" value="ok">

            <div class="buttons">
                <button type="submit" name="acao" value="confirmar" class="btn btn-success">Confirmar</button>
                <button type="submit" name="acao" value="voltar" class="btn btn-warning">Voltar - Não Cadastrar</button>
            </div>

            <div class="grid">
                <input type="text" class="form-control" placeholder="CPF" name="cpf">
                <input type="text" class="form-control" placeholder="Nome" name="nome">
                <input type="phone" class="form-control" placeholder="Telefone" name="telefone">
                <input type="text" class="form-control"placeholder="Endereço" name="endereco">
            </div>
        </form>
    </div>
</div>
</body>
</html>
