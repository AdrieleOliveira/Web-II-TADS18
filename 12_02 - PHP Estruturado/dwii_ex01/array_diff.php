<?php
	
	$arr1 = array(	"Dom" => "Domingo", 
				"Seg" => "Segunda",
				"Ter" => "Terça",
				"Qua" => "Quarta",
				"Qui" => "Quinta",
				"Sex" => "Sexta",
				"Sab" => "Sábado"
			);

	$arr2 = array(	"Dom" => "Domingo", 
				"Seg" => "Segunda",
				"Qua" => "Quarta",
				"Qui" => "Quinta",
				"Sab" => "Sábado"
			);

	
	$dif = array_diff($arr1, $arr2);

	echo "DIFERENÇA<br>";
	foreach($dif as $cha => $val) {
		echo "($cha) $val<br>";
	}

	$dif = array_diff($arr2, $arr1);

	echo "<br>DIFERENÇA<br>";
	foreach($dif as $cha => $val) {
		echo "($cha) $val<br>";
	}
?>


