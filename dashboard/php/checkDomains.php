<?php

include "../../src/database.php";

$base_url = "https://api.cloudflare.com/client/v4/";
$apiKey = '';
$email = '';
$accid = '';

// select * from domains
$sql = "SELECT * FROM domains";
$result = mysqli_query($db, $sql);
