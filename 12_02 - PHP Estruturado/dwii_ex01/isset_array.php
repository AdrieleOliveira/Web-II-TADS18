<?php
	
	$dados = array(	"nome" => "gil",
      			"cpf" => "000.000.000-00",
      			"email" => NULL
   			);

	
	$bool = isset ($dados["nome"]);
	if($bool) { echo "A chave 'nome' FOI inicializada!"; }
	else { echo "A chave 'nome' NÃO FOI inicializada!"; }

	echo "<br><br>";

	$bool = isset ($dados["email"]);
	if($bool) { echo "A chave 'email' FOI inicializada!"; }
	else { echo "A chave 'email' NÃO FOI inicializada!"; }
?>


