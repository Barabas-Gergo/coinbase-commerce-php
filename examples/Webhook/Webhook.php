<?php
require_once __DIR__ . "/vendor/autoload.php";

use CoinbaseCommerce\Webhook;

/**
 * To run this example please read README.md file
 * Past your webhook secret from Settings/Webhook section
 */
$secret = 'YOUR_SECRET_KEY';
$headerName = 'X-Cc-Webhook-Signature';
$headers = getallheaders();
$signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
$payload = trim(file_get_contents('php://input'));

try {
    $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
    http_response_code(200);
    echo sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
} catch (\Exception $exception) {
    http_response_code(400);
    echo 'Error occured. ' . $exception->getMessage();
}





