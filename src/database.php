<?php

$dbHost = "localhost";
$dbUser = "user";
$dbPass = "password";
$dbName = "name";


$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
