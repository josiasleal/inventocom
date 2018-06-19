<?php

	$host = "mysql.braslink.com";
	$user = "comeosbr";
	$pass= "eiNgio6f";
	$banco = "comeosbr";
	$conexao = mysqli_connect($host, $user, $pass) or die(mysqli_error());
	// $conexao = mysqli_connect($host, $user, $pass) or die(mysqli_error());

	mysqli_select_db($conexao, $banco) or die(mysqli_error($conexao));

	mysqli_set_charset($conexao, 'UTF8');
?>