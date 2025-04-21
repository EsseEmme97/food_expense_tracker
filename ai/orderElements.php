<?php
require_once("./gemini.php");
use AI\GeminiClient;
header('Content-Type: application/json');

$json = file_get_contents("php://input");

$data = json_decode($json, true);

$dataAsString = implode(",", array_map(function($item) {
	return "[".$item["name"].",".$item["quantita"]."]";
}, $data["list"]));


$gemini = new GeminiClient();
$ai_response = $gemini->generateWithStructuredOutput($dataAsString);
echo $ai_response;