<?php header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

  if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') return;

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo $_SERVER['REQUEST_METHOD'];
    header(':', true, 405);
    echo ' Method Not Allowed';
    return;
  };

  try{
    require '../conn.php';
    $data = json_decode(file_get_contents('php://input'), true);
    $registerToken = addslashes($data['registerToken']);
    
    if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $pergunta = addslashes($data['pergunta']);
      $resposta = addslashes($data['resposta']);

      $sqlPerguntas = "UPDATE `app_enquetes_respostas` SET `votos` = votos+1 WHERE `app_enquetes_respostas`.`id` = '$resposta' ";
      $resultPerguntas = $conn->query($sqlPerguntas);

      echo '1';

    }else{
      echo 'Token inválido: ' . $registerToken;
    };
  } catch (PDOException $e) {
    echo $e->getMessage();
	}

?>