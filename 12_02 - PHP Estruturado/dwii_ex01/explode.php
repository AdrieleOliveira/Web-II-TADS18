<?php
	// Array: função explode()
	$nomes = "maria joão josé neusa";
	$exp = explode(" ", $nomes);

	echo "[nomes]: ";
	for($a=0; $a<count($exp); $a++) {
		echo "$exp[$a] ";
	}

	$turmas = "2015|2016|2017";
	$exp = explode("|", $turmas);

	echo "<br>[turmas]: ";
	foreach ($exp as $dado) {
		echo "$dado ";
	}
?>


