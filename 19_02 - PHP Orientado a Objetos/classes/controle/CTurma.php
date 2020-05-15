<?php

    session_start();

    include_once '../../global.php';

class CTurma {

    public static function index() {
        echo "<script>window.location='../../recursos/view/turma.php'</script>";
    }

    public static function rota() {

        $dados = explode("/", $_POST['acao']);

        if(strcmp($dados[0], "cadastrar") == 0) {
            self::cadastrar();
        }
        else if(strcmp($dados[0], "alterar") == 0) {
            self::alterar($dados[1]);
        }
        else if(strcmp($dados[0], "remover") == 0) {
            self::remover($dados[1]);
        }
        else if(strcmp($dados[0], "confirmar") == 0) {
            self::confirmar($dados[1]);
        }
        else if(strcmp($dados[0], "finalizar") == 0) {
            self::finalizar($dados[1]);
        }
    }

    public static function cadastrar() {
        echo "<script>window.location='../../recursos/view/turmaCadastrar.php'</script>";
    }

    public static function alterar($id) {

        $turma = Turma::findTurma($id);

        if(empty($turma)) {
            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
            $_SESSION['MSGBOX_MSG'] = "O ID informado para a turma não existe!";
            $_SESSION['MSGBOX_LINK'] = "turma.php";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

            echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
        }
        else {

            $url = "../view/turmaAlterar.php?id=$turma->id";
            $url .= "&nome=$turma->nome";
            $url .= "&ano=$turma->ano";

            echo "<script>window.location='".$url."'</script>";
        }
    }

    public static function remover($id) {

        $turma = Turma::findTurma($id);

        if(empty($turma)) {
            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
            $_SESSION['MSGBOX_MSG'] = "O ID informado para a turma não existe!";
            $_SESSION['MSGBOX_LINK'] = "turma.php";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

            echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
        }
        else {

            $url = "../view/turmaRemover.php?id=$turma->id";
            $url .= "&nome=$turma->nome";
            echo "<script>window.location='".$url."'</script>";
        }
    }

    public static function confirmar($id) {

        if($_POST['nome'] != "" && $_POST['ano'] != "") {

            $dados_turma = array("nome" => mb_strtoupper($_POST['nome'], 'UTF-8'),
                "ano" => mb_strtoupper($_POST['ano'], 'UTF-8')
            );

            // Inserir
            if($id == 0) {
                Turma::addTurma($dados_turma);
                $_SESSION['MSGBOX_MSG'] = "A turma foi cadastrada no sistema!";
            }
            // Alterar
            else {
                Turma::upTurma($id, $dados_turma);
                $_SESSION['MSGBOX_MSG'] = "Os dados da turma foram alterados no sistema!";
            }

            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
            $_SESSION['MSGBOX_LINK'] = "turma.php";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

            echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
        }
        else {
            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
            $_SESSION['MSGBOX_MSG'] = "Todos os campos devem ser preenchidos!";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-warning";

            if($id == 0) { $_SESSION['MSGBOX_LINK'] = "turmaCadastrar.php"; }
            else { $_SESSION['MSGBOX_LINK'] = "turmaAlterar.php"; }
        }
    }

    public static function finalizar($id) {

        Turma::delTurma($id);

        $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
        $_SESSION['MSGBOX_MSG'] = "A turma foi removida do sistema!";
        $_SESSION['MSGBOX_LINK'] = "turma.php";
        $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

        echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
    }

    public static function loadTabelaTurma() {

        $turmas = Turma::getTurmas();

        while($objTurma = $turmas->fetchObject()) {

            echo "<tr>";
                echo "<td>".$objTurma->nome."</td>";
                echo "<td>".$objTurma->ano."</td>";

                echo "<td>";
                    echo "<button type='submit' name='acao' value='alterar/".$objTurma->id."'>";
                        echo "<img src='../img/edit.svg'>";
                    echo "</button>";
                    echo "&nbsp";
                    echo "<button type='submit' name='acao' value='remover/".$objTurma->id."'>";
                        echo "<img src='../img/delete.svg'>";
                    echo "</button>";
                echo "</td>";
            echo "</tr>";
        }
    }


}
