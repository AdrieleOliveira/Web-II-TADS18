<?php
	
	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => "web@gileduardo.com.br"
   			);

	$value = "gil";
	$bool = in_array($value, $dados);
	
	if($bool) { echo "O valor '$value' está presente no array!"; }
	else { echo "O valor '$value' não está presente no array!"; }
?>


