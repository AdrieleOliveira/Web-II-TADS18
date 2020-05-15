<?php

    include_once '../../global.php';

    class Curso extends BD {

        public static $tabela = 'tb_curso';

        public static function getCursos(){

            return parent::selectAll(self::$tabela, "ORDER BY nome");
        }

        public static function findCurso($id){
            return parent::selectFind(self::$tabela, "id = $id");
        }

        public static function addCurso($dados_curso){

            return parent::insert(self::$tabela, $dados_curso);
        }

        public static function upCurso($id, $dados){
            return parent::update(self::$tabela, $dados, "id = $id");
        }

        public static function delCurso($id){
            return parent::delete(self::$tabela, "id = $id");
        }

    }