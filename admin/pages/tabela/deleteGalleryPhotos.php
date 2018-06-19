<?php header("Content-Type:text/html; charset=UTF-8");
include '../../aut.php';
include '../../access.php';

	try{
    $id = addslashes($_GET['p']);
    if($id && is_numeric($id)){
      $sql = "SELECT * FROM `app_lazer_gallery` WHERE `id` = $id";
      $result = mysqli_query($conexao, $sql);
      if (mysqli_num_rows($result) == 0) {
        echo "Não foi encontrado nenhuma notícia.";
        exit;
      }
      while ($row = mysqli_fetch_assoc($result)) {
        $filename = str_replace('http://aplicativo.comerciarios.org.br/', $_SERVER["DOCUMENT_ROOT"] . '/', $row["url"]);
        unlink($filename);
      }
      $sql = mysqli_query($conexao, "DELETE FROM app_lazer_gallery WHERE `id` = '$id'") or die(mysql_error());
      echo "Foto deletada com sucesso!";
      echo '<br><br><a href="javascript:history.back()">Voltar</a>';
    }else{
      echo 'Houve um erro ao tentar deletar sua foto. Por favor tente novamente.';
    }
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>