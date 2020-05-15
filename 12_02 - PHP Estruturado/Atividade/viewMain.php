<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include_once ("controle.php");

    if(!empty($_POST["form_submit"])){
        rotas($_POST['acao']);
    }
?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Pessoas Físicas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <div class="container">
        <h1>Pessoas Físicas Cadastradas</h1>
        <hr>

        <form class="form" method="post" action="viewMain.php">
            <input type="hidden" name="form_submit" value="ok">
            <button type="submit" name="acao" value="cadastrar/0" class="btn btn-primary btn-lg btn-block">Cadastrar Nova Pessoa Física</button>
        </form>

        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col">NOME</th>
                    <th scope="col">ENDEREÇO</th>
                    <th scope="col">TELEFONE</th>
                    <th scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php carregar(); ?>
            </tbody>
        </table>
    </div>
</body>
</html>
