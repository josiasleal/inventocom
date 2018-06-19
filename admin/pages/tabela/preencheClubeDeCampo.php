<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';
	include '../../functions.php';

	$coletivo = realToDB(addslashes($_POST['5']));
	$adicional = realToDB(addslashes($_POST['6']));
	$dependente = realToDB(addslashes($_POST['7']));
	$diaria = realToDB(addslashes($_POST['8']));
	$entrada = realToDB(addslashes($_POST['9']));

	mysqli_query($conexao, "UPDATE `app_clubedecampotable` SET `valor` = '$coletivo' WHERE `app_clubedecampotable`.`id` = 5") or die(mysqli_error($conexao));;
	mysqli_query($conexao, "UPDATE `app_clubedecampotable` SET `valor` = '$adicional' WHERE `app_clubedecampotable`.`id` = 6") or die(mysqli_error($conexao));;
	mysqli_query($conexao, "UPDATE `app_clubedecampotable` SET `valor` = '$dependente' WHERE `app_clubedecampotable`.`id` = 7") or die(mysqli_error($conexao));;
	mysqli_query($conexao, "UPDATE `app_clubedecampotable` SET `valor` = '$diaria' WHERE `app_clubedecampotable`.`id` = 8") or die(mysqli_error($conexao));;
	mysqli_query($conexao, "UPDATE `app_clubedecampotable` SET `valor` = '$entrada' WHERE `app_clubedecampotable`.`id` = 9") or die(mysqli_error($conexao));;


	echo "Os valores foram atualizados com sucesso!";
	echo '<br><br><a href="javascript:history.back()">Voltar</a>';

?>