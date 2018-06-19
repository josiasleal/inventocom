<?php 
	session_start();

	if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['pass']) == true)) {
		unset($_SESSION['user']);
		unset($_SESSION['pass']);
		header('location:/admin/login.php');
		// header('location:/sindicato/admin/login.php');//TODO: DESENV
	}

	$logado = $_SESSION['user'];
?>