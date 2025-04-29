<?php
// proxy.php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$apiKey = 'NWJ40W4ZRG7R802I'; // jouw echte Alpha Vantage API key

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $function = $_POST['function'] ?? '';
    $symbol = $_POST['symbol'] ?? 'SLS';
    $from = $_POST['from_currency'] ?? 'USD';
    $to = $_POST['to_currency'] ?? 'EUR';

    $url = '';

    if ($function === 'GLOBAL_QUOTE') {
        $url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=$symbol&apikey=$apiKey";
    } elseif ($function === 'CURRENCY_EXCHANGE_RATE') {
        $url = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=$from&to_currency=$to&apikey=$apiKey";
    } else {
        echo json_encode(['error' => 'Ongeldige functie.']);
        exit;
    }

    $response = file_get_contents($url);
    if ($response === false) {
        echo json_encode(['error' => 'API-aanvraag mislukt.']);
    } else {
        echo $response;
    }
} else {
    echo json_encode(['error' => 'Alleen POST-verzoeken toegestaan.']);
}
?>
