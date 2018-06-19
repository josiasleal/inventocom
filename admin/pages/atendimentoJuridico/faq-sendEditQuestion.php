<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  try{
    $id = addslashes($_POST['qst']);
    $categoria = addslashes($_POST['categoria']);
    $pergunta = addslashes($_POST['pergunta']);
    $resposta = addslashes(trim($_POST['resposta']));

    mysqli_query($conexao,
      "UPDATE `app_faq` 
      SET `categoria` = '$categoria',
      `pergunta` = '$pergunta',
      `resposta` = '$resposta'
      WHERE `id` = '$id'"
    ) or die(mysqli_error($conexao)
    );;

    echo "O conteúdo foi editado com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>