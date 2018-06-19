<?php

  try {
    $conn = new PDO("mysql:host=mysql.braslink.com;dbname=comeosbr", "comeosbr", "eiNgio6f");
    $conn->exec("SET CHARACTER SET utf8");
    $conn->exec("SET NAMES 'utf8'");
    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
    echo $e->getMessage();
	}

?>