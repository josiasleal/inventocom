<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  $tipoDeLazer = addslashes($_POST['tipoDeLazer']);

  try{
    /* Upload de imagem */
    $files = array();
    $fdata = $_FILES["image"];
    if (!empty($fdata["name"]) && is_array($fdata["name"])) {
      for ($i = 0; $i < count($fdata['name']); ++$i) {
        $files[] = array(
          'name' => $fdata['name'][$i],
          'tmp_name' => $fdata['tmp_name'][$i],
        );
      };
      foreach ($files as $file) {
        $extensao = pathinfo ( $file['name'], PATHINFO_EXTENSION );
        $extensao = strtolower ( $extensao );
        if (strstr ( '.jpg;', $extensao ) ) {
          $image = preg_replace('/\s+/', '', $file);
          $imageName = rand(1, 900000) . $file['name'];
          $destino = '../../../app-data/api/img/'. $tipoDeLazer . '/gallery/' . $imageName;
          move_uploaded_file( $file['tmp_name'], $destino);

          $url = 'http://aplicativo.comerciarios.org.br/app-data/api/img/' . $tipoDeLazer . '/gallery/' . $imageName;
          $query = "INSERT INTO app_lazer_gallery (`url`, `categoria`) VALUES ('$url', '$tipoDeLazer')";
          mysqli_query($conexao, $query) or die(mysqli_error($conexao));
        };
      };
    };

    echo "Imagens inseridas com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>