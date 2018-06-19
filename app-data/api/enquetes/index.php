<?php header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

  // if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') return;

  // if($_SERVER['REQUEST_METHOD'] != 'POST'){
  //   echo $_SERVER['REQUEST_METHOD'];
  //   header(':', true, 405);
  //   echo ' Method Not Allowed';
  //   return;
  // };

  try{
    require '../conn.php';
    
    $data = json_decode(file_get_contents('php://input'), true);
    // $registerToken = addslashes($data['registerToken']);
    // $categoria = addslashes($data['categoria']);

    // if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $sqlPerguntas = "SELECT * FROM app_enquetes_perguntas WHERE app_enquetes_perguntas.vencimento > CURDATE() AND app_enquetes_perguntas.status = 'ativada'";
      $resultPerguntas = $conn->query($sqlPerguntas);
      $finalOutput = array();

      while($row = $resultPerguntas->fetch(PDO::FETCH_ASSOC)){
        $perguntaAtual = $row["pergunta"];
        $perguntaAtualId = $row["id"];

        $localOutput = new stdClass();
        $localOutput->title = $perguntaAtual;
        $localOutput->id = $perguntaAtualId;

        $itemArr = array();

        $resultResposta = $conn->query("SELECT * from `app_enquetes_respostas` WHERE pergunta_id = '$perguntaAtualId'");
        while($rowRespostas = $resultResposta->fetch(PDO::FETCH_ASSOC)){
          $item = new stdClass();
          $item->opcao = $rowRespostas["opcao"];
          $item->resposta = $rowRespostas["resposta"];
          $item->votos = $rowRespostas["votos"];
          $item->id = $rowRespostas["id"];
          array_push($itemArr, $item );
        };
        $localOutput->questions = $itemArr;
        array_push($finalOutput, $localOutput);
      };
      echo json_encode($finalOutput);

      // echo ($results) ? json_encode($results) : "Não foi encontrada nenhuma foto.";

    //  }else{
      // echo 'Token inválido: ' . $registerToken;
    // };
  } catch (PDOException $e) {
    echo $e->getMessage();
	}

?>