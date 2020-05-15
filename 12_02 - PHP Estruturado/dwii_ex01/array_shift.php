<?php
	
	$estoque = array("up", "gol", "golf", "jetta");

	echo "ESTOQUE: ";
	foreach($estoque as $item) {
		echo "$item ";
	}

	$carro = array_shift($estoque);
	echo "<br>REMOVIDO: $carro<br>";

	echo "ESTOQUE: ";
	foreach($estoque as $item) {
		echo "$item ";
	}
?>


