<?php

require "../src/database.php";

$sql = "SELECT * FROM users";
$result = $db->query($sql);
$count = mysqli_num_rows($result);


$sql = "SELECT `banned` FROM `users` WHERE `banned`='true'";
$result = $db->query($sql);
$banned_count = $result->num_rows;

$sql = "SELECT id FROM uploads";
$result = $db->query($sql);
$upload_count = $result->num_rows;

$print = array(
    "user_count" => $count,
    "banned_count" => $banned_count,
    "upload_count" => $upload_count
);

echo json_encode($print);
