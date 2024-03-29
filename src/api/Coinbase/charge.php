<?php

require "../../database.php";

if (!isset($_SESSION)) { session_start(); }


$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];


require_once "../../vendor/autoload.php";

use CoinbaseCommerce\Resources\Charge;
use CoinbaseCommerce\ApiClient;

ApiClient::init('bd352c70-cb34-4306-ac59-873b2c855a91');


$chargeData = [
    'name' => 'Helist Premium upgrade',
    'description' => 'Unlock all features of Helist Premium :)',
    "metadata" => [
        "customer_id" => $id,
    ],
    'local_price' => [
        'amount' => '6.00',
        'currency' => 'EUR'
    ],
    'pricing_type' => 'fixed_price'
];
$chargeObj = Charge::create($chargeData);

//var_dump($chargeObj);
var_dump($chargeObj->hosted_url);
header("Location: {$chargeObj->hosted_url}");

?>
