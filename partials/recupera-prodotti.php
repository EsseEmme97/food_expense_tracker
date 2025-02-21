<?php
include("../utils/db-connection.php");
header('Content-Type: application/json');
	$list_id = $_GET["numero"];

	$sql = "SELECT * FROM lists WHERE id=:list_id";
	$statement = $connection->prepare($sql);

	try {
		$statement->execute([":list_id" => $list_id]);
	} catch (PDOException $e) {
		echo "errore durante il carimento dei dati" . $e->getMessage();
	}

	$list = $statement->fetch(PDO::FETCH_ASSOC);
	if (!$list) {
		echo json_encode(["response"=>"lista non trovata"]);
	}
	echo json_encode($list);
