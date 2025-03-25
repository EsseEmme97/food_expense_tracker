<?php
include("../utils/db-connection.php");
header('Content-Type: application/json');

$sql = "SELECT * FROM costs";
$statement = $connection->prepare($sql);

try {
    $statement->execute();
    $costs = $statement->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo json_encode(["response" => "Errore durante il caricamento dei dati", "error" => $e->getMessage()]);
    exit;
}

if (!$costs) {
    echo json_encode([]);
    exit;
}

echo json_encode($costs);
