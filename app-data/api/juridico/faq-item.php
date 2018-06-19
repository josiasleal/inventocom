<?php header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

  if($_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'OPTIONS'){
    echo $_SERVER['REQUEST_METHOD'];
    header(':', true, 405);
    echo ' Method Not Allowed';
    return;
  };

  try{
    require '../conn.php';
    
    $data = json_decode(file_get_contents('php://input'), true);
    $registerToken = addslashes($data['registerToken']);
    $categoria = addslashes($data['categoria']);
    $result = array();

    if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $resultPerguntas = $conn->query("SELECT * from `app_faq` WHERE categoria = '$categoria'");
      while($rowPerguntas = $resultPerguntas->fetch(PDO::FETCH_ASSOC)){
        $item = new stdClass();
        $item->pergunta = $rowPerguntas["pergunta"];
        $item->resposta = $rowPerguntas["resposta"];
        array_push($result, $item );
      };
      echo json_encode($result);

     }else{
      echo 'Token inválido: ' . $registerToken;
    };
  } catch (PDOException $e) {
    echo $e->getMessage();
	}

?>