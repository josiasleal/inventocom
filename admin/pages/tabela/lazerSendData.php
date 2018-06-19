<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  try{
    $tipoDeLazer = addslashes($_POST['tipoDeLazer']);
    $titulo = addslashes($_POST['titulo']);
    $description = addslashes($_POST['description']);
    $telefone = addslashes($_POST['telefone']);
    $localizacao = addslashes($_POST['localizacao']);
    $gmaps_embed = addslashes($_POST['gmaps_embed']);
    $gmaps_link = addslashes($_POST['gmaps_link']);
    /* Upload de img_cover */
    $imgUploaded = $_FILES['img_cover']['name'];
    
    if(!empty($imgUploaded)){
      $extensao = pathinfo ( $imgUploaded, PATHINFO_EXTENSION );
      $extensao = strtolower ( $extensao );
      if (strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        $img_cover = preg_replace('/\s+/', '', $imgUploaded);
        $destino = '../../../app-data/api/img/'. $tipoDeLazer . '/img_cover' . '.' . pathinfo ( $img_cover, PATHINFO_EXTENSION );
        move_uploaded_file( $_FILES['img_cover']['tmp_name'], $destino);
      }
    }

    $query = "UPDATE app_lazer
      SET `titulo` = '$titulo',
        `description` = '$description',
        `telefone` = '$telefone',
        `localizacao` = '$localizacao',
        `gmaps_embed` = '$gmaps_embed',
        `gmaps_link` = '$gmaps_link'
      WHERE categoria = '$tipoDeLazer'";
    
    mysqli_query($conexao, $query) or die(mysqli_error($conexao));

    echo "O conteúdo foi atualizado com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>