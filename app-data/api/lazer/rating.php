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
    $categoria = addslashes($data['categoria']);

    if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $sql = "SELECT rating FROM `app_lazer_rating` WHERE `categoria` = '$categoria'";
      $stmt = $conn->query($sql);
      $number = 0;
      $count = 0;
      
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $number += $row['rating'];
        $count += 1;
      };

      echo ceil($number / $count);
     }else{
      echo 'Token inválido: ' . $registerToken;
    };
  } catch (PDOException $e) {
    echo $e->getMessage();
	}

?>