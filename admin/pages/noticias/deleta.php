<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<?php include '../../aut.php' ?>
<?php include '../../access.php' ?>

<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="robots" CONTENT="noindex, nofollow">
	<title>Deleta Notícia</title>

</head>
<body>
	
<?php

	$id = $_GET['id'];

		$sql = mysqli_query($conexao, "DELETE FROM `novab704_comerciarios`.`app_noticias` WHERE `id` = '$id'") or die(mysql_error());
		echo "Sua notícia foi deletada com sucesso!";
		echo '<br><br><a href="javascript:history.back()">Voltar</a>';

?>


</body>
</html>	