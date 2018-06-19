<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  if(
    $_SERVER['HTTP_REFERER'] != 'http://aplicativo.comerciarios.org.br/admin/pages/enquetes/index.php' &&
    $_SERVER['HTTP_REFERER'] != 'https://aplicativo.comerciarios.org.br/admin/pages/enquetes/index.php'
  ){
    echo 'Você só pode excluir perguntas pelo fluxo do admin.';
    return;
  };

  try{
    $id = addslashes($_GET['eqt']);

    mysqli_query($conexao, "DELETE FROM app_enquetes_perguntas WHERE `id` = '$id'") or die(mysql_error());
    mysqli_query($conexao, "DELETE FROM app_enquetes_respostas WHERE `pergunta_id` IN ('$id') ") or die(mysql_error());

    echo "O conteúdo foi deletado com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>