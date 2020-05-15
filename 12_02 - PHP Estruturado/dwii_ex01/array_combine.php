<?php
	
	$chave = array(1, 2, 3, 4);
	$valor = array("up", "gol", "golf", "jetta");

	$carros = array_combine($chave, $valor);

	echo "ESTOQUE<br>";
	foreach($carros as $cha => $val) {
		echo "($cha) $val<br>";
	}
?>


