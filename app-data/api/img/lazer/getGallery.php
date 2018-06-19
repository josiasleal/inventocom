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
    require '../../conn.php';
    
    $data = json_decode(file_get_contents('php://input'), true);
    $registerToken = addslashes($data['registerToken']);
    $categoria = addslashes($data['categoria']);

    if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $sql = "SELECT * FROM `app_lazer_gallery` WHERE `categoria` = '$categoria' ORDER BY `id` asc";
      $stmt = $conn->query($sql);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo ($results) ? json_encode($results) : "Não foi encontrada nenhuma foto.";
     }else{
      echo 'Token inválido: ' . $registerToken;
    };
  } catch (PDOException $e) {
    echo $e->getMessage();
	}

?>