<?php

    include_once '../../global.php';

    class CMain {

        public static function index() {
            echo "<script>window.location='recursos/view/main.php'</script>";
        }

        public static function rota() {

            $dados = explode("/", $_POST['acao']);

            if(strcmp($dados[0], "aluno") == 0) {
                CAluno::index();
            }
            else if(strcmp($dados[0], "curso") == 0) {
                CCurso::index();
            }
            else if(strcmp($dados[0], "turma") == 0) {
                 CTurma::index();
            }
        }
    }
