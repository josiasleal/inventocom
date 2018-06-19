<?php session_start();

	$user = addslashes($_POST["user"]);
	$pass = addslashes($_POST["pass"]);

	if( $user == "adminapp" && $pass == "appcomerciarios15" ){
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		header('location:index.php');
	}else{
		unset ($_SESSION['user']);
		unset ($_SESSION['pass']);
		echo 'Login ou senha inválido <br><br>';
		echo '<a href="javascript:history.back()">Voltar</a>';
	} 

 ?>