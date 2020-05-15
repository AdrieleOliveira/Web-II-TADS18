<?php
	
	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => "web@gileduardo.com.br"
   			);

	$chaves = array_values($dados);

	echo "VALORES: ";
	foreach($chaves as $item) {
		echo "$item ";
	}
?>


