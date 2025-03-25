<?php
include("../utils/db-connection.php");
header('Content-Type: application/json');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$sql="INSERT INTO costs(data_spesa,importo) values (:data_spesa,:importo)";

$statement= $connection->prepare($sql);

try{
	$statement->execute([":data_spesa"=>$data["data_spesa"],":importo"=>(float)$data["importo"]]);
	echo json_encode(["success"=>"dati inseriti correttamente"]);
} catch (PDOException $e){
	echo json_encode(["error"=>"spesa già inserita, modificare l'importo di una spesa esistente"]);
}