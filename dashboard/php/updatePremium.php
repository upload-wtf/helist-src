<?php

include "../../src/database.php";

$username = $_POST['username'];
$payment_status = $_POST['status'];

if (empty($payment_status)) {
     echo "Empty payment status";
     exit;
}
if (empty($username)) {
     echo "Empty username";
     exit;
}

if($payment_status == "COMPLETED") {

     $sql = "UPDATE users SET premium = 1 WHERE username = '$username'";
     $result = mysqli_query($db, $sql);
     if ($result) {
          echo "[DB]Premium updated";
     } else {
          echo "[DB]Error updating premium";
     }

} else {
     echo "[Payment]Error updating premium";
}
