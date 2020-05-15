<?php session_start(); ?>

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

        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class=" <?php echo $_SESSION['MSGBOX_CLASSE'];; ?> ">
                        <h4><strong> <?php echo $_SESSION['MSGBOX_TITULO'];?> </strong></h4>
                        <?php echo $_SESSION['MSGBOX_MSG'];?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?php echo $_SESSION['MSGBOX_LINK'];?>" type="button" class="btn btn-default">OK</a>
                </div>
            </div>
        </div>

        <div class="page-header">
    		<b>&copy;2020&nbsp;&nbsp;&raquo;&nbsp;&nbsp; Gil Eduardo de Andrade</b>
    	</div>
    </div>
</body>
</html>
