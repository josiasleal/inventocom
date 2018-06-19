<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  if(strpos( $_SERVER['HTTP_REFERER'], "aplicativo.comerciarios.org.br/admin/pages/atendimentoJuridico/faq.php")){
    echo 'Você só pode excluir perguntas pelo fluxo do admin.' . $_SERVER['HTTP_REFERER'];
    return;
  };

  try{
    $id = addslashes($_GET['qst']);

    mysqli_query($conexao, "DELETE FROM app_faq WHERE `id` = '$id'") or die(mysql_error());

    echo "O conteúdo foi deletado com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>