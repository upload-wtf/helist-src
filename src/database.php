<?php

$dbHost = "localhost";
$dbUser = "s5370_uploader";
$dbPass = "#6mW7s2o2";
$dbName = "s5370_uploader";


$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
