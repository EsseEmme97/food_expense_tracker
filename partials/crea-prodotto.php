<?php
include("../utils/db-connection.php");

header('Content-Type: application/json');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!isset($data["list"])) {
    echo json_encode(["error" => "Missing 'list' parameter"]);
    exit;
}

$list = $data["list"];
$date_of_creation = date("Y-m-d");

$sql = "INSERT INTO lists (data_creazione, elements) 
        VALUES (:date, :elements)
        ON CONFLICT(data_creazione) 
        DO UPDATE SET elements = :elements";

$statement = $connection->prepare($sql);

try {
    $statement->execute([
        ":date" => $date_of_creation,
        ":elements" => json_encode($list) 
    ]);
    
    echo json_encode(["response" => "dati salvati correttamente"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
