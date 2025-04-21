<?php

namespace AI;
include_once("./ai_config.php");

class GeminiClient
{
	private $apiKey;
	private $ch;

	public function __construct()
	{
		$this->apiKey = GEMINI_API_KEY;
		$this->ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$this->apiKey}");
	}

	public function generateWithStructuredOutput($data)
	{
		$prompt="dato il seguente ordine di reparti in un supermercato: [panettoni e dolci tipici,bibite,carne,pesce,pasticceria,yogurt e insaccati,surgelati,salse,olii e aceti, scatolame, brodi vari, pane a lunga durata,biscotti] ordina i seugenti elementi seguendo l'ordine dei reparti". $data."Se alcuni elementi non appartengono ad alcun reparto, aggiungili al fondo della lista";
		
		$dataStructure = [
			'contents' => [
				[
					'parts' => [
						[
							'text' => $prompt
						]
					]
				]
			],
			"generationConfig" => [
				"response_mime_type" => "application/json",
				"response_schema"=>[
					"type" => "Array",
					"items" => [
						"type" => "object",
						"properties"=>[
							"name" => ["type" => "string"],
							"quantita" => ["type" => "integer"],
						]
					]
				]
			]
		];
		$payload = json_encode($dataStructure);

		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($this->ch, CURLOPT_POST, true);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $payload);

		$response = curl_exec($this->ch);

		if (curl_errno($this->ch)) {
			echo 'Curl error: ' . curl_error($this->ch);
		} else {
			$responseData = json_decode($response, true);
			if (isset($responseData["candidates"][0]["content"]["parts"][0]["text"])) {
				$ai_response = $responseData["candidates"][0]["content"]["parts"][0]["text"];
				echo $ai_response;
			} else {
				echo "Errore: Impossibile accedere al testo nella risposta JSON.\n";
				var_dump($responseData);
			}
		}

		curl_close($this->ch);
	}
}



