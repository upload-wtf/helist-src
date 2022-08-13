<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "discord.php";
require "config.php";
require "database.php";

init($redirect_url, $client_id, $secret_id, $bot_token);


get_user();

$sql = "SELECT * FROM `users` WHERE `discord_id` = '" . $user->id . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$dcid = $row['discord_id'];

if ($dcid == "") {
     header("Location: ../register");
} else {
     // create session
     session_start();
     $_SESSION['loggedin'] = true;
     $_SESSION['banned'] = $row['banned'];
     $_SESSION['username'] = $row["username"];
     $_SESSION['uploads'] = $row['uploads'];

     header("Location: ../dashboard");

}
