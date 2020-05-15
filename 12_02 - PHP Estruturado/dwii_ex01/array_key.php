<?php
	
	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => "web@gileduardo.com.br"
   			);

	$chaves = array_keys($dados);

	echo "CHAVES: ";
	foreach($chaves as $item) {
		echo "$item ";
	}
?>


