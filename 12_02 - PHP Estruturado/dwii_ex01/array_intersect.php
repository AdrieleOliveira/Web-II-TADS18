<?php
	
	$arr1 = array(	"Dom" => "Domingo", 
				"Ter" => "Terça",
				"Qua" => "Quarta",
				"Qui" => "Quinta",
				"Sex" => "Sexta"
			);

	$arr2 = array(	"Dom" => "Domingo", 
				"Seg" => "Segunda",
				"Qua" => "Quarta",
				"Qui" => "Quinta",
				"Sab" => "Sábado"
			);

	
	$dif = array_intersect($arr1, $arr2);

	echo "INTERSECCÃO<br>";
	foreach($dif as $cha => $val) {
		echo "($cha) $val<br>";
	}

	$dif = array_intersect($arr2, $arr1);

	echo "<br>INTERSECCÃO<br>";
	foreach($dif as $cha => $val) {
		echo "($cha) $val<br>";
	}
?>


