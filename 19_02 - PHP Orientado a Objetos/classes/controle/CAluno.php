<?php

    session_start();

    include_once '../../global.php';

    class CAluno {

        public static function index() {
            echo "<script>window.location='../../recursos/view/aluno.php'</script>";
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
            echo "<script>window.location='../../recursos/view/alunoCadastrar.php'</script>";
        }

        public static function alterar($id) {

            $aluno = Aluno::findAluno($id);

            if(empty($aluno)) {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para o aluno não existe!";
                $_SESSION['MSGBOX_LINK'] = "aluno.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
            }
            else {

                $url = "../view/alunoAlterar.php?id=$aluno->id";
                $url .= "&nome=$aluno->nome";
                $url .= "&curso=$aluno->curso";
                $url .= "&turma=$aluno->turma";

                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function remover($id) {

            $aluno = Aluno::findAluno($id);

            if(empty($aluno)) {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para o aluno não existe!";
                $_SESSION['MSGBOX_LINK'] = "aluno.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
            }
            else {

                $url = "../view/alunoRemover.php?id=$aluno->id";
                $url .= "&nome=$aluno->nome";
                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function confirmar($id) {

            if($_POST['nome'] != "" && $_POST['curso'] != "" && $_POST['turma'] != "") {

                $dados_aluno = array("nome" => mb_strtoupper($_POST['nome'], 'UTF-8'),
                    "curso" => mb_strtoupper($_POST['curso'], 'UTF-8'),
                    "turma" => mb_strtoupper($_POST['turma'], 'UTF-8')
                );

                // Inserir
                if($id == 0) {
                    Aluno::addAluno($dados_aluno);
                    $_SESSION['MSGBOX_MSG'] = "O aluno foi cadastrado no sistema!";
                }
                // Alterar
                else {
                    Aluno::upAluno($id, $dados_aluno);
                    $_SESSION['MSGBOX_MSG'] = "Os dados do aluno foram alterados no sistema!";
                }

                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
                $_SESSION['MSGBOX_LINK'] = "aluno.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

                echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
            }
            else {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "Todos os campos devem ser preenchidos!";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-warning";

                if($id == 0) { $_SESSION['MSGBOX_LINK'] = "alunoCadastrar.php"; }
                else { $_SESSION['MSGBOX_LINK'] = "alunoAlterar.php"; }
            }
        }

        public static function finalizar($id) {

            Aluno::delAluno($id);

            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
            $_SESSION['MSGBOX_MSG'] = "O aluno foi removido do sistema!";
            $_SESSION['MSGBOX_LINK'] = "aluno.php";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

            echo "<script>window.location='../../recursos/view/messagebox.php'</script>";
        }

        public static function loadTabelaAlunos() {

			$alunos = Aluno::getAlunos();

            while($objAluno = $alunos->fetchObject()) {

            	echo "<tr>";
                    echo "<td>".$objAluno->nome."</td>";
                    echo "<td>".$objAluno->curso."</td>";
                    echo "<td>".$objAluno->turma."</td>";

					echo "<td>";
						echo "<button type='submit' name='acao' value='alterar/".$objAluno->id."'>";
							echo "<img src='../img/edit.svg'>";
						echo "</button>";
						echo "&nbsp";
						echo "<button type='submit' name='acao' value='remover/".$objAluno->id."'>";
							echo "<img src='../img/delete.svg'>";
						echo "</button>";
					echo "</td>";
				echo "</tr>";
    		}
    	}

        public static function loadComboTurma() {

            $turma = Turma::getTurmas();

            echo "<select name='turma' class='form-control'>";
            echo "<option value=''></option>";

            while($objTurma = $turma->fetchObject()) {
                echo "<option value='".$objTurma->nome."'>".$objTurma->nome."</option>";
            }

            echo "</select>";
        }

        public static function loadComboSelecionado($selected) {

            $turma = Turma::getTurmas();

            echo "<select name='turma' class='form-control'>";
            echo "<option value=''></option>";

            while($objTurma = $turma->fetchObject()) {

                if($selected == $objTurma->nome)
                    echo "<option value='".$objTurma->nome."' selected>".$objTurma->nome."</option>";
                else
                    echo "<option value='".$objTurma->nome."'>".$objTurma->nome."</option>";
            }

            echo "</select>";
        }

        public static function loadComboCurso() {

            $cursos = Curso::getCursos();

            echo "<select name='curso' class='form-control'>";
            echo "<option value=''></option>";

            while($objCurso = $cursos->fetchObject()) {
                echo "<option value='".$objCurso->nome."'>".$objCurso->nome."</option>";
            }

            echo "</select>";
        }

        public static function loadComboSelecionadoCurso($selected) {

            $cursos = Curso::getCursos();

            echo "<select name='curso' class='form-control'>";
            echo "<option value=''></option>";

            while($objCurso = $cursos->fetchObject()) {

                if($selected == $objCurso->nome)
                    echo "<option value='".$objCurso->nome."' selected>".$objCurso->nome."</option>";
                else
                    echo "<option value='".$objCurso->nome."'>".$objCurso->nome."</option>";
            }

            echo "</select>";
        }
    }
