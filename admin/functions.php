<?php

	function realBR($valor) {
	  return number_format($valor, 2, ',', '.');
	};

	function realBRUnit($valor) {
	  return 'R$ ' . number_format($valor, 2, ',', '.');
	};

	function realToDB($valor) {

		$valor = str_replace("." , "" , $valor );
		$valor = str_replace("," , "." , $valor);
		$valor = number_format($valor, 2, '.', '');

		if($valor == 0.00){
			$valor = NULL;
		}

		return $valor;
	};


?>