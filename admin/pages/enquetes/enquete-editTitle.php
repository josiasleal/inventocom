<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  try{
    $id = addslashes($_POST['n']);
    $pergunta = addslashes($_POST['pergunta']);

    mysqli_query($conexao,
      "UPDATE `app_enquetes_perguntas` SET `pergunta` = '$pergunta' WHERE `id` = '$id'"
    ) or die(mysqli_error($conexao));

    echo "A pergunta foi editada com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>