<?php

    session_start();

    include_once '../../global.php';

    class CCurso{

        public static function index(){
            echo "<script>window.location='../../recursos/view/curso.php'</script>";
        }

        public static function rota(){
            $dados = explode("/", $_POST['acao']);

            if(strcmp($dados[0], "cadastrar") == 0){
                self::cadastrar();
            } else if(strcmp($dados[0], "confirmar") == 0){
                self::confirmar($dados[1]);
            } else if(strcmp($dados[0], "alterar") == 0){
                self::alterar($dados[1]);
            } else if(strcmp($dados[0], "remover") == 0){
                self::remover($dados[1]);
            } else if(strcmp($dados[0], "finalizar") == 0){
                self::finalizar($dados[1]);
            }
        }

        public static function cadastrar(){
            echo "<script>window.location='../../recursos/view/cursoCadastrar.php'</script>";
        }

        public static function alterar($id){

            $curso = Curso::findCurso($id);

            if(empty($curso)){
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para o curso não existe!";
                $_SESSION['MSGBOX_LINK'] = "curso.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
            } else {
                $url = "../view/cursoAlterar.php?id=$curso->id";
                $url .= "&nome=$curso->nome";
                $url .= "&eixo=$curso->eixo";
                $url .= "&nivel=$curso->nivel";

                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function remover($id){
            $curso = Curso::findCurso($id);

            if(empty($curso)) {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para o curso não existe!";
                $_SESSION['MSGBOX_LINK'] = "curso.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
            }
            else {

                $url = "../view/cursoRemover.php?id=$curso->id";
                $url .= "&nome=$curso->nome";
                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function confirmar($id){

            if($_POST['nome'] != "" && $_POST['eixo'] != "" && $_POST['nivel'] != "") {
                $dados_curso = array("nome" => mb_strtoupper($_POST['nome'], 'UTF-8'),
                    "eixo" => mb_strtoupper($_POST['eixo'], 'UTF-8'),
                    "nivel" => mb_strtoupper($_POST['nivel'], 'UTF-8')
                );

                //inserir
                if($id == 0){
                    Curso::addCurso($dados_curso);
                    $_SESSION['MSGBOX_MSG'] = "O curso foi cadastrado no sistema!";
                }
                //alterar
                else{
                    Curso::upCurso($id, $dados_curso);
                    $_SESSION['MSGBOX_MSG'] = "Os dados do curso foram alterados no sistema!";
                }

                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
                $_SESSION['MSGBOX_LINK'] = "curso.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

                echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
            }
            else {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "Todos os campos devem ser preenchidos!";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-warning";

                if($id == 0) { $_SESSION['MSGBOX_LINK'] = "cursoCadastrar.php"; }
                else { $_SESSION['MSGBOX_LINK'] = "cursoAlterar.php"; }
            }
        }

        public function finalizar($id){
            Curso::delCurso($id);

            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
            $_SESSION['MSGBOX_MSG'] = "O curso foi removido do sistema!";
            $_SESSION['MSGBOX_LINK'] = "curso.php";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

            echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
        }

        public static function loadTabelaCursos(){

            $cursos = Curso::getCursos();

            while($objCurso = $cursos->fetchObject()){

                echo "<tr>";
                    echo "<td>".$objCurso->nome."</td>";
                    echo "<td>".$objCurso->eixo."</td>";
                    echo "<td>".$objCurso->nivel."</td>";

                    echo "<td>";
                        echo "<button type='submit' name='acao' value='alterar/".$objCurso->id."'>";
                            echo "<img src='../img/edit.svg'>";
                        echo "</button>";
                        echo "&nbsp";
                        echo "<button type='submit' name='acao' value='remover/".$objCurso->id."'>";
                            echo "<img src='../img/delete.svg'>";
                        echo "</button>";
                    echo "</td>";
                echo "</tr>";
            }
        }




    }
