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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

        <form class="form" method="post" action="aluno.php">
            <input TYPE="hidden" NAME="form_submit" VALUE="OK">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <h3> Deseja remover o aluno? <br><br><b><?php echo $_GET['nome']; ?></b></h3>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" name="acao" value="finalizar/<?php echo $_GET['id']; ?>" class="btn btn-success">Sim</button>
                        <a href="aluno.php" type="button" class="btn btn-danger">Não</a>
                    </div>
                </div>
            </div>
        </form>

        <div class="page-header">
    		<b>&copy;2020&nbsp;&nbsp;&raquo;&nbsp;&nbsp; Gil Eduardo de Andrade</b>
    	</div>
    </div>
</body>
</html>
