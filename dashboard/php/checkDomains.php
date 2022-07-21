<?php

include "../../src/database.php";

$base_url = "https://api.cloudflare.com/client/v4/";
$apiKey = 'a593dfbd9b955688e5c5f6ba768495076bbc2';
$email = 'alexandermitru07@gmail.com';
$accid = 'c719ea39b7f3af5cd26a95a58b2d4ac2';

// select * from domains
$sql = "SELECT * FROM domains";
$result = mysqli_query($db, $sql);
