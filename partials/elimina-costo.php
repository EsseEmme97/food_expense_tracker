<?php
include("../utils/db-connection.php");
header('Content-Type: application/json');

$json = file_get_contents("php://input");

$data = json_decode($json, true);

$sql="DELETE FROM costs WHERE id=:id";

$statement= $connection->prepare($sql);

try{
	$statement->execute([":id"=>$data["id"]]);
	echo json_encode(["success"=>"dato eliminato correttamente"]);
} catch (PDOException $e){
	echo json_encode(["error"=>"impossibile eliminare il dato"]);
}