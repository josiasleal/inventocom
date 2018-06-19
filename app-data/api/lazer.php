<?php header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

  if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') return;

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo $_SERVER['REQUEST_METHOD'];
    header(':', true, 405);
    echo 'Method Not Allowed';
    return;
  };

	try {
    $conn = new PDO("mysql:host=mysql.braslink.com;dbname=comeosbr", "comeosbr", "eiNgio6f");
    $conn->exec("SET CHARACTER SET utf8");
    $conn->exec("SET NAMES 'utf8'");
    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
    echo $e->getMessage();
	}

  $data = json_decode(file_get_contents('php://input'), true);
  $registerToken = addslashes($data['registerToken']);
  $categoria = addslashes($data['categoria']);

  try{
    if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $categoria = addslashes($categoria);
      $query = "SELECT * from app_lazer where categoria = '$categoria'";
      $stmt = $conn->query($query);
      $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $json=json_encode($results);
      echo $json;
    }else{
      echo 'Token inválido: ' . $registerToken;
    };
  } catch (PDOException $e) {
    echo 'ERRO AO CARREGAR CONTEÚDO: '.$e->getMessage();
	}

?>