<?php

require "../../database.php";
require_once "../../vendor/autoload.php";

if (!isset($_SESSION)) { session_start(); }


$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

use CoinbaseCommerce\Webhook;

$secret = '';
$headerName = 'x-cc-webhook-signature';
$headers = getallheaders();
$signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
$payload = trim(file_get_contents('php://input'));

try 
{
    $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
    http_response_code(200);

    $type = $event->type;
    $sessionid = $event->data->metadata->customer_id;

    $create = "UPDATE users SET premium = 1 WHERE username = $username";
    $result = mysqli_query($db, $create);

    echo "Success";



    echo sprintf('Successully verified event with id %s and type %s.', $event->id, $event->type);
} 
catch (\Exception $exception) {
    http_response_code(400);
    echo 'Error occured. ' . $exception->getMessage();
}

?>