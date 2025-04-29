<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$apiKey = "EIAJO8OXS2GX0NNF";

if (!isset($_POST['function'])) {
    http_response_code(400);
    echo json_encode(["error" => "No function specified."]);
    exit;
}

$url = "https://www.alphavantage.co/query?" . http_build_query($_POST) . "&apikey=" . $apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

curl_close($ch);

echo $response;
?>
