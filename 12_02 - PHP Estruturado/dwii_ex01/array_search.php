<?php
	
	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => "web@gileduardo.com.br"
   			);

	$chave = array_search("000.000.000-00", $dados);
	echo "CHAVE: $chave<br>";

	$chave = array_search("000.000.000-01", $dados);
	echo "CHAVE: $chave";
?>


