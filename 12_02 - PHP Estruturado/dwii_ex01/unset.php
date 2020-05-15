<?php
		
	$var=12;

	if(isset($var)) { echo "A variável \$var FOI inicializada!"; }
	else { echo "A variável \$var NÃO FOI inicializada!"; }

	echo "<br>";
	unset($var);

	if(isset($var)) { echo "A variável \$var FOI inicializada!"; }
	else { echo "A variável \$var NÃO FOI inicializada!"; }
?>


