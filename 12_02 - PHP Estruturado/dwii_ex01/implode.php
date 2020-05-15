<?php
	// Array: função implode()
	$arr = array('gil', 'eduardo', 'andrade');
	$nome = implode(" ", $arr);
	echo "NOME: $nome<br>";


	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => "web@gileduardo.com.br"
   			);

	// Constroi uma query
	$sql  = "INSERT INTO tb_prof";
	$sql .= " (".implode(", ", array_keys($dados)).")";
	$sql .= " VALUES ('".implode("', '", $dados)."') ";

	echo "QUERY: $sql";

?>


