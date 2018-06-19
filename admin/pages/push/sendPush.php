<?php

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		header(':', true, 405);
		echo 'Method Not Allowed';
		return;
	};

	$registerToken = $_POST['registerToken'];

	if($registerToken != '059d7a3ecce6a74f5a7040a99de136bc'){
		echo 'Token inválido: ' . $registerToken;
		return;
	};

	$platform = $_POST['platform'];
	$devices = array();
	// $devices = ['fpdiEZfJwOI:APA91bFE9OT4Ly1VCZHBt0QQq2A-DPDTz2GXbN16bxzkDipF0lwKHeamISf2GSnxI5rxO75wHJbGTE9r1PRE575IRfUuNNkc9UOYor2RXN7T2UOfZpesGTTOkHRUVUEWsAZQIvFmyOCy'];

	try {
			$conn = new PDO("mysql:host=mysql.braslink.com;dbname=comeosbr", "comeosbr", "eiNgio6f");
			$conn->exec("SET CHARACTER SET utf8");
			$conn->exec("SET NAMES 'utf8'");
			$conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$nRows = $conn->query("SELECT COUNT(*) FROM app_devices WHERE platform='$platform'")->fetchColumn();

			$qtd = ceil($nRows / 1000);

			if($nRows > 999){
				for ($i = 1; $i <= $qtd; $i++) {
					$from = ($i-1)*1000;
					$to = $i*1000;
					$stmt = $conn->query = "SELECT * FROM app_devices order by id LIMIT $from, $to";
					$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach($results as $row) {
						array_push($devices,$row['device_id']);
					};
					sendPush($devices, $platform);
				}
			}else{
				$stmt = $conn->query("SELECT * FROM app_devices where `platform` = '$platform'");
				$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach($results as $row) {
					array_push($devices,$row['device_id']);
				};
				sendPush($devices, $platform);
			}

	} catch (PDOException $e) {
			echo $e->getMessage();
	}

	function sendPush($devices, $platform){
		// Set parameters:
		$apiKey = 'AIzaSyAPLQSC2nZJxH-OXkzHh8i06ebBkJZlGX0'; // API key from Google Developer Console
		$gcmUrl = 'https://gcm-http.googleapis.com/gcm/send';

		if($platform == 'Android'){
			// Set message:
			$title = addslashes($_POST['titleAndroid']);
			$message = addslashes($_POST['msgAndroid']);
			$pushData = array(
				'registration_ids' => $devices,
				'data' => array(
					'title' => $title,
					'message' => $message,
					'image' => 'iconxhdpi',
					'icon' => 'iconpush'
				)
			);
		}else if($platform == 'iOS'){
			$message = addslashes($_POST['msgIOs']);
			$pushData = array(
				'registration_ids' => $devices,
				'priority' => 'high',
				'notification' => array(
					'body' => $message,
					'priority' => 'high',
					'content-available' => '1'
				)
			);
		};
	
		// Send message:
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $gcmUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
				array(
						'Authorization: key=' . $apiKey,
						'Content-Type: application/json'
				)
		);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pushData) );

		$result = curl_exec($ch);
		if ($result === false) {
				throw new Exception(curl_error($ch));
		}

		curl_close($ch);
		echo $result;
	}

?>