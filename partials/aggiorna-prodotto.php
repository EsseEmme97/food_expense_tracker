<?php
include("../utils/db-connection.php");

header('Content-Type: application/json');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$sql= "UPDATE lists SET elements=:list WHERE id=:id";

$statement= $connection->prepare($sql);

try{
	$statement->execute([":list"=>json_encode($data["list"]), "id"=>(int)$data["id"]]);
}catch (PDOException $e){
	echo "errore nell'invio dei dati". $e->getMessage();
}

echo "dati salvati correttamente";