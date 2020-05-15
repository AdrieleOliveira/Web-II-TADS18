<?php
		
	// Uma variável é considerada vazia se não existir ou seu valor for igual NULL/false.

	if(empty($var)) { echo "A variável \$var ESTÁ vazia!<br>"; }
	else { echo "A variável \$var NÃO ESTÁ vazia!<br>"; }

	$var;

	if(empty($var)) { echo "A variável \$var ESTÁ vazia!<br>"; }
	else { echo "A variável \$var NÃO ESTÁ vazia!<br>"; }

	$var = NULL;

	if(empty($var)) { echo "A variável \$var ESTÁ vazia!<br>"; }
	else { echo "A variável \$var NÃO ESTÁ vazia!<br>"; }

	$var = false;

	if(empty($var)) { echo "A variável \$var ESTÁ vazia!<br>"; }
	else { echo "A variável \$var NÃO ESTÁ vazia!<br>"; }

	$var = true;

	if(empty($var)) { echo "A variável \$var ESTÁ vazia!<br>"; }
	else { echo "A variável \$var NÃO ESTÁ vazia!<br>"; }

	$var = 12;

	if(empty($var)) { echo "A variável \$var ESTÁ vazia!<br>"; }
	else { echo "A variável \$var NÃO ESTÁ vazia!<br>"; }
?>


