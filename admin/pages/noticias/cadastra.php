<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

	$titulo = $_POST['titulo'];
	$chamada = $_POST['chamada'];
	$categoria = $_POST['categoria'];
	$destino = '../../img/noticias/' . $_FILES['imagem']['name'];
 	$arquivo_tmp = $_FILES['imagem']['tmp_name'];
 	$imagem = $_FILES['imagem']['name'];
 
	move_uploaded_file( $arquivo_tmp, $destino);

	$sql = mysqli_query($conexao, "INSERT INTO `novab704_comerciarios`.`app_noticias` (`titulo`, `chamada`, `categoria`, `imagem`)
		VALUES ('$titulo', '$chamada', '$categoria', '$imagem')") or die(mysqli_error($conexao));
	echo "Sua notícia foi cadastrada com sucesso!";
	echo '<br><br><a href="javascript:history.back()">Voltar</a>';

?>