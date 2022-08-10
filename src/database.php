<?php

$dbHost = "localhost";
$dbUser = "root1";
$dbPass = "7pzO8l!49";
$dbName = "clynt_helist";


$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
