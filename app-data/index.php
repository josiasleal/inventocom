<?php header("Access-Control-Allow-Origin: *");

try {
    $conn = new PDO(
    'mysql:host=br226.hostgator.com.br;dbname=novab704_comerciarios', 'novab704_comerc', 'appcomerciarios15',
        array(
            PDO::ATTR_PERSISTENT => true
        )
    );
    $conn->exec("SET CHARACTER SET utf8");
    $conn->exec("SET NAMES 'utf8'");
    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$stmt = $conn->query(
    "SELECT * FROM `app_noticias` ORDER BY id DESC LIMIT 5"
);


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);

// $final = htmlspecialchars($json, ENT_QUOTES);
$final = $json;

print_r($final);

?>