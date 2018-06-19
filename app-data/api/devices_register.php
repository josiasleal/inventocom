<?php header("Access-Control-Allow-Origin: *");

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
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

  $device_id = addslashes($data['device_id']);
  $platform = addslashes($data['platform']);
  $uuid = addslashes($data['uuid']);
  $registerToken = $data['registerToken'];

  try{
    if($registerToken == 'b93136f6223bb2d0fd8ba1a7ad153fec'){
      $query = "INSERT INTO `app_devices` (`device_id`, `platform`, `uuid`) VALUES ('$device_id', '$platform', '$uuid')";
      $stmt = $conn->exec($query);
      print_r($stmt);
    }else{
      echo 'Token inválido: ' . $registerToken;
    };
  } catch (PDOException $e) {
			echo 'ERRO AO REGISTRAR DEVICE: '.$e->getMessage();
	}

?>