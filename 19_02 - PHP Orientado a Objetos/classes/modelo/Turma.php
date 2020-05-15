<?php

include_once '../../global.php';

class Turma extends BD {

    public static $tabela = 'tb_turma';

    public static function getTurmas() {

        return parent::selectAll(self::$tabela, "ORDER BY nome");
    }

    public static function findTurma($id) {

        return parent::selectFind(self::$tabela, "id = $id");
    }

    public static function addTurma($dados_turma) {

        return parent::insert(self::$tabela, $dados_turma);
    }

    public static function upTurma($id, $dados) {

        return parent::update(self::$tabela, $dados, "id = $id");
    }

    public static function delTurma($id) {

        return parent::delete(self::$tabela, "id = $id");
    }
}
