<?php

include("../utils/db-connection.php");
header('Content-Type: application/json');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$sql="INSERT INTO lists (data_creazione, elements)
SELECT date('now', 'localtime'), elements FROM lists WHERE id = :id";

$statement=$connection->prepare($sql);

try{
	$statement->execute(["id"=>$data["id"]]);
}catch (PDOException $e){
	echo "errore nell'eliminare la richiesta". $e->getMessage();
}

echo "dati duplicati correttamente";