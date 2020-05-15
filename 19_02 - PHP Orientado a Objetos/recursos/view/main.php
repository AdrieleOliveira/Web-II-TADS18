<?php

    include_once '../../global.php';

    if( !empty($_POST['form_submit']) ) {
        CMain::rota();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>

   <link rel="icon" href="../img/favicon.ico">
    <title>Sistema Acadêmico - DWII</title>

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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

    <div class="page-header">
        <h2 class="form-signin-heading">
            <div id="m_texto"> Menu Principal </div>
        </h2>
    </div>

    <form class="form" method="post" action="main.php">
        <input TYPE="hidden" NAME="form_submit" VALUE="OK">

        <div class='row'>

            <div class='col-sm-3' style="text-align: center">
                <button type="submit" name="acao" value="aluno/">
                    <img src="../img/aluno_ico.png">
                </button>
				<h3><b>Aluno</b></h3>
            </div>

            <div class='col-sm-3' style="text-align: center">
				<button type="submit" name="acao" value="curso/">
                    <img src="../img/curso_ico.png">
                </button>
				<h3><b>Curso</b></h3>
            </div>

            <div class='col-sm-3' style="text-align: center">
                <button type="submit" name="acao" value="turma/">
                    <img src="../img/turma_ico.png">
                </button>
				<h3><b>Turma</b></h3>
            </div>

        </div>
    </form>

	<div class="page-header">
		<b>&copy;2020&nbsp;&nbsp;&raquo;&nbsp;&nbsp; Gil Eduardo de Andrade</b>
	</div>

    </div> <!-- /container -->
  </body>
</html>
