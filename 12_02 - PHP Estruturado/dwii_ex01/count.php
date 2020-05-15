<?php
	
	$estoque = array("up", "gol", "golf", "jetta");

	echo "ESTOQUE: ";
	foreach($estoque as $item) {
		echo "$item ";
	}

	$total = count($estoque);

	echo "<br>TOTAL: $total";
?>


