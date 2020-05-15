<?php
	
	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => "web@gileduardo.com.br"
   			);

	$key = "cpf";
	$bool = array_key_exists($key, $dados);
	
	if($bool) { echo "A chave '$key' está presente no array!"; }
	else { echo "A chave '$key' não está presente no array!"; }
?>


