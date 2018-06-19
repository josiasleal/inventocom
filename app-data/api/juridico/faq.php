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
      $sqlDistinct = "SELECT DISTINCT(categoria) from `app_faq`";
      $resultDistinct = $conn->query($sqlDistinct);
      $finalOutput = array();

      while($row = $resultDistinct->fetch(PDO::FETCH_ASSOC)){
        $categoriaAtual = $row["categoria"];

        $localOutput = new stdClass();
        $localOutput->title = $categoriaAtual;

        $itemArr = array();

        $resultPerguntas = $conn->query("SELECT * from `app_faq` WHERE categoria = '$categoriaAtual'");
        while($rowPerguntas = $resultPerguntas->fetch(PDO::FETCH_ASSOC)){
          $item = new stdClass();
          $item->pergunta = $rowPerguntas["pergunta"];
          $item->resposta = $rowPerguntas["resposta"];
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