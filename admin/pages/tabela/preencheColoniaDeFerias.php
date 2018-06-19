<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';
	include '../../functions.php';

	$associadoUm = realToDB(addslashes($_POST['1Um']));
	$associadoDois = realToDB(addslashes($_POST['1Dois']));

	$outrosParentesUm = realToDB(addslashes($_POST['2Um']));
	$outrosParentesDois = realToDB(addslashes($_POST['2Dois']));

	$dependentesUm = realToDB(addslashes($_POST['3Um']));
	$dependentesDois = realToDB(addslashes($_POST['3Dois']));

	$convidadosAssocUm = realToDB(addslashes($_POST['4Um']));
	$convidadosAssocDois = realToDB(addslashes($_POST['4Dois']));
	
	$socioUsuarioUm = realToDB(addslashes($_POST['5Um']));
	$socioUsuarioDois = realToDB(addslashes($_POST['5Dois']));

	$outrosParentesSUUm = realToDB(addslashes($_POST['6Um']));
	$outrosParentesSUDois = realToDB(addslashes($_POST['6Dois']));

	$convidadosSUUm = realToDB(addslashes($_POST['7Um']));
	$convidadosSUDois = realToDB(addslashes($_POST['7Dois']));


	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$associadoUm', `valorDois` = '$associadoDois' WHERE `app_coloniadeferiastable`.`id` = 1") or die(mysqli_error($conexao));
	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$outrosParentesUm', `valorDois` = '$outrosParentesDois' WHERE `app_coloniadeferiastable`.`id` = 2") or die(mysqli_error($conexao));
	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$dependentesUm', `valorDois` = '$dependentesDois' WHERE `app_coloniadeferiastable`.`id` = 3") or die(mysqli_error($conexao));
	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$convidadosAssocUm', `valorDois` = '$convidadosAssocDois' WHERE `app_coloniadeferiastable`.`id` = 4") or die(mysqli_error($conexao));
	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$socioUsuarioUm', `valorDois` = '$socioUsuarioDois' WHERE `app_coloniadeferiastable`.`id` = 5") or die(mysqli_error($conexao));
	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$outrosParentesSUUm', `valorDois` = '$outrosParentesSUDois' WHERE `app_coloniadeferiastable`.`id` = 6") or die(mysqli_error($conexao));
	mysqli_query($conexao, "UPDATE `app_coloniadeferiastable` SET `valorUm` = '$convidadosSUUm', `valorDois` = '$convidadosSUDois' WHERE `app_coloniadeferiastable`.`id` = 7") or die(mysqli_error($conexao));


	echo "Os valores foram atualizados com sucesso!";
	echo '<br><br><a href="javascript:history.back()">Voltar</a>';

?>