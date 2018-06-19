<?php header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

  try{
    require '../conn.php';
    
    $data = json_decode(file_get_contents('php://input'), true);

      $sqlPerguntas = "SELECT * FROM app_enquetes_perguntas WHERE id = '69047'";
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

  } catch (PDOException $e) {
    echo $e->getMessage();
	}

?>