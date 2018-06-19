<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  try{
    $categoria = addslashes($_POST['categoria']);
    $pergunta = addslashes($_POST['pergunta']);
    $resposta = addslashes($_POST['resposta']);
    
    $query = "INSERT INTO app_faq (`categoria`, `pergunta`, `resposta`) VALUES ('$categoria', '$pergunta', '$resposta')";
    mysqli_query($conexao, $query) or die(mysqli_error($conexao));

    echo "O conteúdo foi inserido com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>