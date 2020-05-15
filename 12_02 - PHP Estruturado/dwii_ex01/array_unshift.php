<?php
	
	$estoque = array("up", "gol", "golf", "jetta");

	echo "ESTOQUE: ";
	foreach($estoque as $item) {
		echo "$item ";
	}

	$carro = "polo";
	echo "<br>ADICIONADO: $carro<br>";

	array_unshift($estoque, $carro);

	echo "ESTOQUE: ";
	foreach($estoque as $item) {
		echo "$item ";
	}

	$c1 = "fox"; 
	$c2 = "fusca";
	echo "<br>ADICIONADOS: $c1 $c2";
	
	array_unshift($estoque, $c1, $c2);

	echo "<br>ESTOQUE: ";
	foreach($estoque as $item) {
		echo "$item ";
	}
?>


