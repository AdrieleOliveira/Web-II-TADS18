<?php

    include_once '../../global.php';

    if( !empty($_POST['form_submit']) ) {
        CAluno::rota();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../css/theme.css" rel="stylesheet">
    <!-- Java Script -->
    <script src="../js/jquery-3.3.1.slim.js"></script>
    <script src="../js/bootstrap.min.js"></script>

  </head>

  <body role="document">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Sistema Acadêmico - DWII</a>
        </div>
	<div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li class="active">
                      <a href="aluno.php"> Aluno </a>
              </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

        <div class="page-header">
            <h2 class="form-signin-heading">
                <div id="m_texto"> Cadastrar Aluno </div>
            </h2>
        </div>

        <form class="form" method="post" action="alunoCadastrar.php">
            <input TYPE="hidden" NAME="form_submit" VALUE="OK">

            <div class='row'>
                <div class="col-sm-6">
                    <label>Nome: </label>
                    <input type="text" name="nome" class="form-control">
                </div>
                <div class="col-sm-4">
                    <label>Curso: </label>
                    <?php
                        CAluno::loadComboCurso();
                    ?>

<!--                    <input type="text" name="curso" class="form-control">-->
                </div>
                <div class="col-sm-2">
                    <label>Turma: </label>
                    <?php
                        CAluno::loadComboTurma();
                    ?>
<!--                    <input type="text" name="turma" class="form-control">-->
                </div>
            </div>
            <br>
            <button type="submit" name="acao" value="confirmar/0" class="btn btn-success btn-block">
                <b>Confirmar</b>
            </button>
        </form>

	<div class="page-header">
		<b>&copy;2020&nbsp;&nbsp;&raquo;&nbsp;&nbsp; Gil Eduardo de Andrade</b>
	</div>
    </div> <!-- /container -->
  </body>
</html>
