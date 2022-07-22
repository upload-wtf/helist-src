<?php

/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   index.php                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: Clynt <mail@clynt.me>                      +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2022/07/21 15:14:48 by Clynt             #+#    #+#             */
/*   Updated: 2022/07/21 15:14:48 by Clynt            ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

include "../src/config.php";
include "../src/database.php";
include "../src/functions.php";


session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
     header("location: ../");
     exit;
}


$username = $_SESSION['username'];


if (isset($_GET['update-settings'])) {
     if (isset($_POST['use_customdomain'])) {
          $sql3 = "UPDATE users SET use_customdomain='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (!isset($_POST['use_customdomain'])) {
          $sql3 = "UPDATE users SET use_customdomain='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['filename_type'])) {
          $sql3 = "UPDATE users SET filename_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_invisible_url'])) {
          $sql3 = "UPDATE users SET use_invisible_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }


     if (isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['self_destruct_upload'])) {
          $sql3 = "UPDATE users SET self_destruct_upload='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_sus_url'])) {
          $sql3 = "UPDATE users SET use_sus_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='long' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['url_type'])) {
          $sql3 = "UPDATE users SET url_type='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     if (isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='true' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='false' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }
     if (!isset($_POST['use_emoji_url'])) {
          $sql3 = "UPDATE users SET use_emoji_url='short' WHERE username='" . $username . "';";
          $result3 = mysqli_query($db, $sql3);
     }

     header("location: /");
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
if ($embed["use_customdomain"] == "true") {

     $usecustomdomain = "checked";
} else {

     $usecustomdomain = "false";
}

if ($embed["use_invisible_url"] == "true") {

     $invisible_url = "checked";
} else {

     $invisible_url = "false";
}
if ($embed["filename_type"] == "long") {

     $uselongfilename = "checked";
} else {

     $uselongfilename = "false";
}

if ($embed["url_type"] == "long") {

     $uselongurl = "checked";
} else {

     $uselongurl = "false";
}
if ($embed["self_destruct_upload"] == "true") {

     $self_destruct_upload = "checked";
} else {

     $self_destruct_upload = "false";
}

if ($embed["use_emoji_url"] == "true") {

     $emoji_url = "checked";
} else {

     $emoji_url = "false";
}

if ($embed["use_sus_url"] == "true") {

     $use_sus_url = "checked";
} else {

     $use_sus_url = "false";
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row["banned"] == "true") {
     header("location: logout.php");
}

if ($row["use_embed"] == "true") {

     $useembed = "checked";
} else {

     $useembed = "false";
}

if (isset($_POST['getNewKey'])) {

     $newSecret = generateRandomInt(16);
     $sql = "UPDATE `users` SET `secret` = '$newSecret' WHERE `username` = '" . $_SESSION['username'] . "'";
     $result = mysqli_query($db, $sql);
     header("location: /");
}

if (isset($_POST['enable-embed'])) {
     $sql = "UPDATE users SET use_embed='true' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);

     header("location: /");
}

if (isset($_POST['disable-embed'])) {
     $sql = "UPDATE users SET use_embed='false' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);

     header("location: /");
}



if (isset($_GET['update-color'])) {
     if (isset($_POST['colorpicker'])) {
          $sql = "UPDATE `users` SET `embedcolor` = '" . $_POST['colorpicker'] . "' WHERE `username` = '" . $_SESSION['username'] . "'";
          $result = mysqli_query($db, $sql);
     }
     header("location: /");
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
$avatar = $embed["avatar"];
$id = $embed["id"];
$regdate = $embed["reg_date"];
$uploads = $embed["uploads"];
$banner = $row['bio_background'];
$username = $row['username'];
$status = $row['status'];
$description = $row['description'];
$premium = $row['premium'];
$admin = $row['admin'];
$custom_domain = $row['use_customdomain'];

$sql = "SELECT secret FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$secret = $row['secret'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_assoc($result);
$subdomain = $rows['subdomain'];
$selecteddomain = $rows['domain'];
$banner = $rows['bio_background'];

if (isset($_POST['update-domain'])) {

     $domain = $_POST['selecteddomain'];
     $subdomain = $_POST['subdomain'];

     $sql = "UPDATE users SET subdomain='" . $_POST['subdomain'] . "' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);
     $sql = "UPDATE users SET domain='" . $_POST['selecteddomain'] . "' WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);


     // check if $subdomain is empty
     if (empty($subdomain)) {
          $sql = "UPDATE users SET upload_domain='" . $_POST['selecteddomain'] . "' WHERE username='" . $username . "';";
          $result = mysqli_query($db, $sql);
     } else {
          $sql = "UPDATE users SET upload_domain='" . $_POST['subdomain'] . "." . $_POST['selecteddomain'] . "' WHERE username='" . $username . "';";
          $result = mysqli_query($db, $sql);
     }

     header("location: /");
}

$errors = array();

if (isset($_POST['usernameChange'])) {

     $errors = "";

     $changeUser = $_POST['usernameChangeField'];
     $password = $_POST['passwordCurrentChangeField'];

     if (empty($changeUser)) {
          $errors = "Username is empty";
     }
     if (empty($password)) {
          $errors = "Password is empty";
     }

     $sql = "SELECT * FROM users WHERE username='$changeUser';";
     $result = mysqli_query($db, $sql);
     $rows = mysqli_fetch_assoc($result);
     $changeUserExists = $rows['username'];
     if ($changeUserExists == $changeUser) {
          $errors = "Username already exists";
     } else {
          $sql = "SELECT * FROM users WHERE username='$username';";
          $result = mysqli_query($db, $sql);
          $rows = mysqli_fetch_assoc($result);
          $passwordCorrect = $rows['password'];
          if (password_verify($password, $passwordCorrect)) {
               $sql = "UPDATE users SET username='$changeUser' WHERE username='$username';";
               $result = mysqli_query($db, $sql);
               $_SESSION['username'] = $changeUser;
               header("location: /");
          } else {
               $errors = "Password is incorrect";
          }
     }
}

if (isset($_POST['passwordChange'])) {

     $errors = "";

     $newPassword = $_POST['passwordChangeField'];
     $currPassword = $_POST['passwordCurrentChangeField'];

     if (empty($newPassword)) {
          $errors = "Your new password is empty";
     }
     if (empty($currPassword)) {
          $errors = "Current password is empty";
     }

     $sql = "SELECT * FROM users WHERE username='$username';";
     $result = mysqli_query($db, $sql);
     $rows = mysqli_fetch_assoc($result);
     $passwordCorrect = $rows['password'];

     if (password_verify($currPassword, $passwordCorrect)) {
          $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
          $sql = "UPDATE users SET password='$newPassword' WHERE username='$username';";
          $result = mysqli_query($db, $sql);
          header("location: /");
     } else {
          $errors = "Current password is incorrect";
     }
}


if (isset($_POST['avatarChange'])) {

     $errors = "";

     $avatar = $_FILES['avatarForm'];

     if ($avatar['size'] > 5000000) {
          $errors = "File is too large";
     }
     if ($avatar['size'] == 0) {
          $errors = "File is empty";
     }

     if ($errors == "") {

          $target_dir = "../pfps/";
          $target_file = $target_dir . $username . ".png";
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          $check = getimagesize($avatar["tmp_name"]);
          if ($check !== false) {
               $uploadOk = 1;
          } else {
               $errors = "File is not an image";
               $uploadOk = 0;
          }

          if (file_exists($target_file)) {
               unlink($target_file);
               $uploadOk = 1;
          }

          if ($uploadOk == 1) {
               move_uploaded_file($avatar["tmp_name"], $target_file);
               $sql = "UPDATE users SET avatar='https://helist.host/pfps/" . $username . ".png' WHERE username='" . $username . "';";
               $result = mysqli_query($db, $sql);
               header("location: /");
          } else {
               $errors = "File upload failed";
          }
     }
}

if (isset($_POST['portfolioChange'])) {

     $desc = $_POST['portfolioChangeField'];

     $sql = "UPDATE users SET description='$desc' WHERE username='$username';";
     $result = mysqli_query($db, $sql);
     header("location: /");
}


if (isset($_POST['statusChange'])) {


     $status = $_POST['statusField'];

     $sql = "UPDATE users SET status='$status' WHERE username='$username';";
     $result = mysqli_query($db, $sql);
     header("location: /");
}


if (isset($_POST['submitDomain'])) {


     $domain = $_POST['domainAddField'];
     $owner = $username;


     // https://api.cloudflare.com/client/v4 base url
     $base_url = "https://api.cloudflare.com/client/v4/";
     $apiKey = '';
     $email = '';
     $accid = '';

     $url = $base_url . "zones";
     $data = array(
          "name" => $domain,
          "account" => array(
               "id" => $accid
          )
     );
     $data_string = json_encode($data);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'X-Auth-Email: ' . $email,
          'X-Auth-Key: ' . $apiKey,
          'Content-Length: ' . strlen($data_string)
     ));
     $result = curl_exec($ch);
     $result = json_decode($result, true);
     curl_close($ch);
     // get zone id from $domain
     $url = $base_url . "zones?name=" . $domain;
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'X-Auth-Email: ' . $email,
          'X-Auth-Key: ' . $apiKey
     ));
     $result = curl_exec($ch);
     $result = json_decode($result, true);
     curl_close($ch);
     $zoneid = $result['result'][0]['id'];

     $url = $base_url . "zones/" . $zoneid . "/nameservers";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'X-Auth-Email: ' . $email,
          'X-Auth-Key: ' . $apiKey
     ));
     $result = curl_exec($ch);
     $result = json_decode($result, true);
     curl_close($ch);
     $ns = $result['result'][0]['name'];

     
          $url = $base_url . "zones/" . $zoneid . "/dns_records";
          $data = array(
               "type" => "A",
               "name" => "@",
               "content" => "37.114.32.201",
               "proxied" => false
          );
          $data_string = json_encode($data);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
               'Content-Type: application/json',
               'X-Auth-Email: ' . $email,
               'X-Auth-Key: ' . $apiKey,
               'Content-Length: ' . strlen($data_string)
          ));
          $result = curl_exec($ch);
          $result = json_decode($result, true);
          $record_id = $result['result']['id'];
          curl_close($ch);

          $url = $base_url . "zones/" . $zoneid . "/dns_records";
          $data = array(
               "type" => "CNAME",
               "name" => "*",
               "content" => $domain,
               "proxied" => false
          );
          $data_string = json_encode($data);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
               'Content-Type: application/json',
               'X-Auth-Email: ' . $email,
               'X-Auth-Key: ' . $apiKey,
               'Content-Length: ' . strlen($data_string)
          ));
          $result = curl_exec($ch);
          $result = json_decode($result, true);
          $record_id = $result['result']['id'];
          curl_close($ch);

          if (isset($result['success']) && $result['success'] == true) {

               if ($ns == "dee.ns.cloudflare.com" || $ns == "everton.ns.cloudflare.com") {

               $sql = "INSERT INTO domains (domain, owner) VALUES ('$domain', '$owner')";
               $result = mysqli_query($db, $sql);
               if ($result) {
                    header("location: /");
               }
               } else {
                    echo "Nameserver not updated try again later or contact support";
               }
          } else {
               $errors = $result['errors'][0]['message'];
          }
}

if (isset($_POST['backgroundChange'])) {

     $errors = "";

     $banner = $_FILES['backgroundForm'];

     if ($banner['size'] > 5000000) {
          $errors = "File is too large";
     }
     if ($banner['size'] == 0) {
          $errors = "File is empty";
     }

     if ($errors == "") {

          $target_dir = "../pfps/";
          $target_file = $target_dir . $username . "-banner.png";
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          $check = getimagesize($banner["tmp_name"]);
          if ($check !== false) {
               $uploadOk = 1;
          } else {
               $errors = "File is not an image";
               $uploadOk = 0;
          }

          if (file_exists($target_file)) {
               unlink($target_file);
               $uploadOk = 1;
          }

          if ($uploadOk == 1) {
               move_uploaded_file($banner["tmp_name"], $target_file);
               $sql = "UPDATE users SET bio_background='https://helist.host/pfps/" . $username . "-banner.png' WHERE username='" . $username . "';";
               $result = mysqli_query($db, $sql);
               header("location: /");
          } else {
               $errors = "File upload failed";
          }
     }
}


if (isset($_POST["colorsChange"])) {

     $modalColor = $_POST['modalColorChangeField'];
     $background = $_POST['backgorundChangeField'];
     $cardColor = $_POST['cardColorChangeField'];
     $bluredCardColor = $_POST['bluredCardColorChangeField'];
     $hoverColor = $_POST['hoverColorChangeField'];
     $bluredModalBody = $_POST['bluredModalBodyChangeField'];
     $hrColor = $_POST['hrColorChangeField'];
     $badgeBorder = $_POST['badgeBorderChangeField'];
     $badgeColor = $_POST['badgeColorChangeField'];

     if (empty($modalColor) || empty($background) || empty($cardColor) || empty($bluredCardColor) || empty($hoverColor) || empty($bluredModalBody) || empty($hrColor) || empty($badgeBorder) || empty($badgeColor)) {
          $errors = "All fields are required";
     }

     $sql = "UPDATE users SET modal_color='$modalColor', back_background='$background', card_color='$cardColor', blured_card_color='$bluredCardColor', hover_color='$hoverColor', modal_body_blured='$bluredModalBody', hr_color='$hrColor', badge_border='$badgeBorder', badge_background_color='$badgeColor' WHERE username='$username';";
     $result = mysqli_query($db, $sql);
     if ($result == false) {
          $errors = "Canot update";
     } else {
          header("location: /");
     }
     header("location: /");
}


if (isset($_GET['update'])) {
     if (isset($_POST['embedtitle']) && isset($_POST['embeddesc']) && isset($_POST['embedauthor'])) {
          $sql2 = "UPDATE users SET embedtitle='" . $_POST['embedtitle'] . "', embedauthor='" . $_POST['embedauthor'] . "', embedtitle='" . $_POST['embedtitle'] . "', embeddesc='" . $_POST['embeddesc'] . "' WHERE username='" . $username . "';";
          $result2 = mysqli_query($db, $sql2);
     }

     header("location: /");
}

?>

<head>
     <meta charset="UTF-8">
     <title>helist.host</title>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <link rel="shortcut icon" type="image/jpg" href="https://helist.host/assets/images/icon.png" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
     <link rel="stylesheet" href="../assets/css/style.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <meta property="og:title" content="helist.host" />
     <meta property="og:description" content="the image host where privacy matters" />
     <meta property="og:type" content="website" />
     <meta property="og:image" content="https://helist.host/assets/images/banner.png" />
     <meta name="theme-color" content="#7f26d9">
     <meta name="twitter:card" content="summary_large_image">
     <script>
          if (window.history.replaceState) {
               window.history.replaceState(null, null, window.location.href);
          }
     </script>
</head>

<body>
     <div class="modal no-blur show d-block" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" style="max-width: 1300px;">
               <div class="modal-body image">
                    <div class="modal-content image">
                         <div class="modal-body image">
                              <img src="../assets/images/header.png" class="top-border-30" style="max-width: 100%; height: 100px; object-fit: cover;">
                              <div class="image-text alternative" style="margin-top: 50px !important;">
                                   <div class="button-group" style="max-width: 100%;">
                                        <nav>
                                             <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                                  <button class="navbar-button active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="true" aria-selected="true"><i class="fas fa-location-arrow white-icon p-0"></i>
                                                       Dashboard
                                                  </button>
                                                  <button class="navbar-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-circle white-icon p-0"></i> Profile
                                                  </button>
                                                  <button class="navbar-button" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false"><i class="fas fa-cogs white-icon p-0"></i> Settings
                                                  </button>
                                                  <button class="navbar-button" id="premium-tab" data-bs-toggle="tab" data-bs-target="#premium" type="button" role="tab" aria-controls="settings" aria-selected="false"><i class="fas fa-star white-icon p-0"></i> Premium
                                                  </button>


                                                  <?php if ($admin == 1) { ?>
                                                       <a href="./admin/">
                                                            <button class="navbar-button" type="button" aria-controls="settings" aria-selected="false"><i class="fas fa-cogs white-icon p-0"></i> Admin
                                                            </button>
                                                       </a>
                                                  <?php } ?>

                                                  <div class="vertical-line">

                                                  </div>
                                                  <form method="post">
                                                       <a href="logout" class="navbar-button"><i class="fas fa-sign-out-alt white-icon p-0"></i> Logout</a>
                                                  </form>
                                             </div>
                                        </nav>
                                   </div>
                              </div>
                         </div>
                         <div class="tab-content">
                              <div id="dashboard" class="tab-pane fade show active">
                                   <div class="modal-content image">
                                        <div class="modal-content border-0">
                                             <?php

                                             if (!empty($errors)) {
                                             ?>
                                                  <div class="card alert error">
                                                       <span>
                                                            <i class="fas error fa-times white-icon p-0"></i> <?php echo $errors; ?>
                                                       </span>
                                                  </div>
                                                  <br>
                                             <?php
                                             } ?>

                                             <div class="header-group">
                                                  <div class="row">
                                                       <div class="col-auto">
                                                            <i class="fas fa-location-arrow square-icon white-icon"></i>
                                                       </div>
                                                       <div class="col-auto p-0">
                                                            <h1 style="line-height: 1;">
                                                                 Dashboard
                                                            </h1><br><br>
                                                            <small>View and manage information.</small>
                                                       </div>
                                                  </div>
                                             </div>
                                             <br>
                                             <div class="row">
                                                  <div class="col-lg-6">
                                                       <div class="card message hover" onclick="document.getElementById('profile-tab').click();">
                                                            <div class="row">
                                                                 <div class="col-auto">
                                                                      <img src="<?php echo $avatar ?>" style="border-radius: 50%; height: 50px; width: 50px; object-fit: cover;">
                                                                 </div>
                                                                 <div class="col-auto p-0">
                                                                      <h1 style="line-height: 1;">
                                                                           <?php echo $username ?>
                                                                      </h1>
                                                                      <small>Edit profile and portfolio.</small>
                                                                 </div>
                                                                 <div class="col-auto my-auto">
                                                                      <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="nav nav-tabs border-0 d-flex justify-content-center" style="margin: 5px; max-width: 100% !important;">
                                                            <button class="navbar-button"><i class="fas fa-user white-icon p-0"></i> User ID: <?php echo $id ?></button>
                                                            <button class="navbar-button"><i class="fas fa-clock white-icon p-0"></i> Registered at: <?php echo $regdate ?></button>
                                                       </div>
                                                       <p class="form-text-lines">
                                                            <span>Your statistics</span>
                                                       </p>
                                                       <div class="row">
                                                            <div class="col" style="padding-right: 0;">
                                                                 <div class="card message">
                                                                      <span>
                                                                           <h1 style="line-height: 0.9;">
                                                                                <?php echo $uploads ?>
                                                                           </h1>
                                                                           <small>Images since your registration</small>
                                                                      </span>
                                                                 </div>
                                                            </div>
                                                            <div class="col" style="padding-left: 0;">
                                                                 <div class="card message">
                                                                      <span>
                                                                           <?php
                                                                           // count the number of invites
                                                                           $sql = "SELECT * FROM `invites` WHERE `inviteAuthor`=" . '"' . $username . '";';
                                                                           $result = mysqli_query($db, $sql);
                                                                           $invite_rows = mysqli_num_rows($result);

                                                                           ?>
                                                                           <h1 style="line-height: 0.9;">
                                                                                <?php echo $invite_rows ?>
                                                                           </h1>
                                                                           <div data-bs-toggle="modal" data-bs-target="#invitesModal">
                                                                                <small>Show invites</small><br>
                                                                           </div>
                                                                      </span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                       <div class="card message" style="padding: 0;">
                                                            <div class="hover">
                                                                 <div class="row" data-bs-toggle="modal" data-bs-target="#usernameModal">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-user rounded-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h2 style="line-height: 1;">
                                                                                Username
                                                                           </h2>
                                                                           <small>Change your public username.</small>
                                                                      </div>
                                                                      <div class="col-auto my-auto">
                                                                           <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                            <div class="hover">
                                                                 <div class="row" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-lock rounded-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h2 style="line-height: 1;">
                                                                                Password
                                                                           </h2>
                                                                           <small>Change your password.</small>
                                                                      </div>
                                                                      <div class="col-auto my-auto">
                                                                           <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <p class="form-text-lines">
                                                            <span>Additional security</span>
                                                       </p>
                                                       <div class="card message">
                                                            <div class="row">
                                                                 <div class="col-auto">
                                                                      <i class="fas fa-shield-alt rounded-icon white-icon"></i>
                                                                 </div>
                                                                 <div class="col-auto p-0">
                                                                      <h2 style="line-height: 1;">
                                                                           2FA (SOON)
                                                                      </h2>
                                                                      <small>Extended security feature.</small>
                                                                 </div>
                                                                 <div class="col-auto my-auto">
                                                                      <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div id="profile" class="tab-pane fade">
                                   <div class="modal-content image">
                                        <div class="modal-content" style="padding: 0;">
                                             <img src="<?php echo $banner ?>" style="width: 100%; height: 100%; border-radius: 0 0 32px 32px !important;">

                                             <div class="image-text alternative" style="top: 25px;">
                                                  <?php

                                                  if (!empty($errors)) {
                                                  ?>
                                                       <div class="card alert error">
                                                            <span>
                                                                 <i class="fas error fa-times white-icon p-0"></i> <?php echo $errors ?>
                                                            </span>
                                                       </div>
                                                       <br>
                                                  <?php
                                                  } ?>
                                             </div>
                                             <div class="image-text alternative">
                                                  <div class="row">
                                                       <div class="col-auto">
                                                            <img src="<?php echo $avatar ?>" style="border-radius: 50%; height: 150px; width: 150px; object-fit: cover;">

                                                            <?php if ($premium == 0) { ?>
                                                                 <div class="d-flex justify-content-center" style="margin-left: 15px; margin-top: 15px; margin-bottom: 15px;">
                                                                      <div class="row align-items-center" style="max-width: 1000px;">
                                                                           <div class="col-auto" style="padding: 0;">
                                                                                <button class="navbar-button active" data-bs-toggle="modal" data-bs-target="#avatarModal">
                                                                                     <i class="fas fa-user white-icon p-0"></i> Change avatar
                                                                                </button>
                                                                           </div>
                                                                           <div class="col-auto" style="padding: 0;">
                                                                                <button class="navbar-button active">
                                                                                     <i class="fas fa-edit white-icon p-0"></i> Change background <i class="fas fa-star premium-icon"></i>
                                                                                </button>
                                                                           </div>
                                                                           <div class="col-auto" style="padding: 0;">
                                                                                <button class="navbar-button active" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                                                                                     <i class="fas fa-align-right white-icon p-0"></i> Edit portfolio
                                                                                </button>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            <?php } else { ?>
                                                                 <div class="d-flex justify-content-center" style="margin-left: 15px; margin-top: 15px; margin-bottom: 15px;">
                                                                      <div class="row" style="max-width: 1000px;">
                                                                           <div class="col-auto" style="padding: 0;">
                                                                                <button class="navbar-button active" data-bs-toggle="modal" data-bs-target="#avatarModal">
                                                                                     <i class="fas fa-user white-icon p-0"></i> Change avatar
                                                                                </button>
                                                                           </div>
                                                                           <div class="col-auto" style="padding: 0;">
                                                                                <button class="navbar-button active" data-bs-toggle="modal" data-bs-target="#backgroundModal">
                                                                                     <i class="fas fa-edit white-icon p-0"></i> Change background <i class="fas fa-star premium-icon"></i>
                                                                                </button>
                                                                           </div>
                                                                           <div class="col-auto" style="padding: 0;">
                                                                                <button class="navbar-button active" data-bs-toggle="modal" data-bs-target="#portfolioModal">
                                                                                     <i class="fas fa-align-right white-icon p-0"></i> Edit portfolio
                                                                                </button>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            <?php } ?>

                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div id="settings" class="tab-pane fade">
                                   <div class="modal-content image">
                                        <div class="modal-content border-0">

                                             <div class="header-group">
                                                  <div class="row">
                                                       <div class="col-auto">
                                                            <i class="fas fa-cogs square-icon white-icon"></i>
                                                       </div>
                                                       <div class="col-auto p-0">
                                                            <h1 style="line-height: 1;">
                                                                 Settings
                                                            </h1><br><br>
                                                            <small>Manage your settings.</small>
                                                       </div>
                                                  </div>
                                             </div>
                                             <br>
                                             <div class="row">
                                                  <div class="col-lg-6">
                                                       <div class="card message hover">
                                                            <div class="row">
                                                                 <div class="col-auto my-auto">
                                                                      <div>
                                                                           <form method="post" action="">
                                                                                <div class="form-check form-switch form-switch-lg align-middle">
                                                                                     <?php
                                                                                     $sql = "SELECT * FROM users WHERE username='$username';";
                                                                                     $result = mysqli_query($db, $sql);
                                                                                     $roww = mysqli_fetch_assoc($result);
                                                                                     if ($roww["use_embed"] == "true") { ?>
                                                                                          <button class="navbar-button active" name="disable-embed">Disable Embed</button>
                                                                                          <!-- <input class="form-check-input" type="checkbox" name="disable-embed" onchange="this.form.submit()" checked /> -->
                                                                                     <?php } else { ?>
                                                                                          <button class="navbar-button active" name="enable-embed">Enable Embed</button>
                                                                                          <!-- <input class="form-check-input" type="checkbox" name="enable-embed" onchange="this.form.submit()" /> -->
                                                                                     <?php } ?>
                                                                                </div>
                                                                           </form>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-auto p-0">
                                                                      <h1 style="line-height: 1;">
                                                                           Embed
                                                                      </h1>
                                                                      <small>Enables an embedded preview.</small>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="nav nav-tabs border-0 d-flex justify-content-center" style="margin: 5px; max-width: 100% !important;">
                                                            <?php
                                                            $sql = "SELECT upload_domain FROM users WHERE username='$username';";
                                                            $result = mysqli_query($db, $sql);
                                                            $roww = mysqli_fetch_assoc($result);
                                                            $upload_domain = $roww["upload_domain"];
                                                            ?>
                                                            <button class="navbar-button"><i class="fas fa-user white-icon p-0"></i> Domain: <?php echo $upload_domain ?></button>
                                                            <form method="post" action="">
                                                                 <button class="navbar-button active" name="getNewKey"><i class="fas fa-sync white-icon p-0"></i> Reset Key</button>
                                                            </form>
                                                            <button class="navbar-button active" onclick="generateConfig()"><i class="fas fa-save white-icon p-0"></i> Download config</button>
                                                       </div>
                                                       <p class="form-text-lines">
                                                            <span>Domain</span>
                                                       </p>
                                                       <div class="row">
                                                            <div class="col" style="padding: 0 15px 15px;">
                                                                 <form method="post">
                                                                      <div class="input-group mb-3">
                                                                           <label class="label">Subdomain</label><br>
                                                                           <input type="text" name="subdomain" class="form-control" value="<?php echo $subdomain ?>" />
                                                                      </div>
                                                                      <div class="input-group mb-3">
                                                                           <select class="form-select" name="selecteddomain" style="margin-top: 5px;">
                                                                                <option class="bg-dark" value="<?php echo $selecteddomain ?>" selected><?php echo $selecteddomain ?></option>
                                                                                <?php
                                                                                $sql = "SELECT name FROM domains";
                                                                                $result = mysqli_query($db, $sql);
                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                     echo "<option class='bg-dark'>" . $row['name'] . "</option>";
                                                                                }
                                                                                ?>
                                                                           </select>
                                                                      </div>
                                                                      <button type="submit" class="button-big" name="update-domain" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                                                                      </button>
                                                                 </form>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                       <div class="card message" style="padding: 0;">
                                                            <div class="hover">
                                                                 <div class="row" data-bs-toggle="modal" data-bs-target="#embedModal">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-align-right rounded-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h2 style="line-height: 1;">
                                                                                Embed fields
                                                                           </h2>
                                                                           <small>Change your embed texts.</small>
                                                                      </div>
                                                                      <div class="col-auto my-auto">
                                                                           <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                            <div class="hover">
                                                                 <div class="row" data-bs-toggle="modal" data-bs-target="#colorModal">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-paint-brush rounded-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h2 style="line-height: 1;">
                                                                                Color
                                                                           </h2>
                                                                           <small>Change your embed color.</small>
                                                                      </div>
                                                                      <div class="col-auto my-auto">
                                                                           <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <p class="form-text-lines">
                                                            <span>Additional settings</span>
                                                       </p>
                                                       <div class="card message" style="padding: 0;">
                                                            <div class="hover">
                                                                 <div class="row" data-bs-toggle="modal" data-bs-target="#urlModal">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-align-right rounded-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h2 style="line-height: 1;">
                                                                                URL types
                                                                           </h2>
                                                                           <small>Use unique URL types.</small>
                                                                      </div>
                                                                      <div class="col-auto my-auto">
                                                                           <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <p class="form-text-lines">
                                                            <span>Submit Domain</span>
                                                       </p>
                                                       <div class="card message" style="padding: 0;">
                                                            <div class="hover">
                                                                 <div class="row" data-bs-toggle="modal" data-bs-target="#domainAddModal">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-align-right rounded-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h2 style="line-height: 1;">
                                                                                Submit Domain
                                                                           </h2>
                                                                           <small>Add your own domain.</small>
                                                                      </div>
                                                                      <div class="col-auto my-auto">
                                                                           <span class="align-middle"><i class="fas fa-chevron-right"></i></span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div id="premium" class="tab-pane fade">
                                   <div class="modal-content image">
                                        <div class="modal-content border-0">

                                             <div class="header-group">
                                                  <div class="row">
                                                       <div class="col-auto">
                                                            <i class="fas fa-star square-icon white-icon"></i>
                                                       </div>
                                                       <div class="col-auto p-0">
                                                            <h1 style="line-height: 1;">
                                                                 Premium
                                                            </h1><br>
                                                            <small>Get more from our host.</small>
                                                       </div>
                                                  </div>
                                             </div>
                                             <br>
                                             <div class="row">
                                                  <div class="col-lg-6">
                                                       <div class="card message">
                                                            <div class="row">
                                                                 <div class="col-auto">
                                                                      <i class="fas fa-user rounded-icon white-icon"></i>
                                                                 </div>
                                                                 <div class="col-auto p-0">
                                                                      <h2 style="line-height: 1;">
                                                                           Classic
                                                                      </h2>
                                                                      <small>Basic functionality and access.</small>
                                                                 </div>
                                                            </div>
                                                            <p class="form-text-lines" style="margin-left: 15px; margin-right: 15px;">
                                                                 <span style="background-color: #0F0F0F;">Features</span>
                                                            </p>
                                                            <div style="margin-left: 15px;">
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Basic access
                                                                           </span>
                                                                           <br>
                                                                           <small>Access to our uploader and website.</small>
                                                                      </div>
                                                                 </div>
                                                                 <p class="form-text-lines" style="border: none;"></p>
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Custom avatar
                                                                           </span>
                                                                           <br>
                                                                           <small>Customized avatar on your portfolio page.</small>
                                                                      </div>
                                                                 </div>
                                                                 <p class="form-text-lines" style="border: none;"></p>
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Custom portfolio
                                                                           </span>
                                                                           <br>
                                                                           <small>Customized texts on your portfolio page.</small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <p class="form-text-lines" style="margin-left: 15px; margin-right: 15px;"></p>
                                                            <button class="navbar-button active" style="width: 100%;" disabled>
                                                                 <i class="fas fa-check white-icon p-0"></i> Subscribed
                                                            </button>
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                       <div class="card message">
                                                            <div class="row">
                                                                 <div class="col-auto">
                                                                      <i class="fas fa-star rounded-icon white-icon"></i>
                                                                 </div>
                                                                 <div class="col-auto p-0">
                                                                      <h2 style="line-height: 1;">
                                                                           Premium
                                                                      </h2>
                                                                      <small>Extended access.</small>
                                                                 </div>
                                                            </div>
                                                            <p class="form-text-lines" style="margin-left: 15px; margin-right: 15px;">
                                                                 <span style="background-color: #0F0F0F;">Features</span>
                                                            </p>
                                                            <div style="margin-left: 15px;">
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Custom profile background
                                                                           </span>
                                                                           <br>
                                                                           <small>Customized profile background.</small>
                                                                      </div>
                                                                 </div>
                                                                 <p class="form-text-lines" style="border: none;"></p>
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Custom profile theme
                                                                           </span>
                                                                           <br>
                                                                           <small>Customized colors on your portfolio page.</small>
                                                                      </div>
                                                                 </div>
                                                                 <p class="form-text-lines" style="border: none;"></p>
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Custom image theme (SOON)
                                                                           </span>
                                                                           <br>
                                                                           <small>Customized colors on image pages.</small>
                                                                      </div>
                                                                 </div>
                                                                 <p class="form-text-lines" style="border: none;"></p>
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-check white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <span style="line-height: 1;">
                                                                                Request an invite
                                                                           </span>
                                                                           <br>
                                                                           <small>Request an invite code monthly.</small>
                                                                      </div>
                                                                 </div>
                                                                 <p class="form-text-lines" style="border: none;"></p>
                                                                 <small>+ all basic features and upcoming features...</small>
                                                            </div>
                                                            <p class="form-text-lines" style="margin-left: 15px; margin-right: 15px;"></p>

                                                            <?php
                                                            if ($premium != "1") { ?>
                                                                 <div id="smart-button-container">
                                                                      <div style="text-align: center;">
                                                                           <div id="paypal-button-container"></div>
                                                                      </div>
                                                                 </div>

                                                            <?php } else { ?>
                                                                 <button class="navbar-button active" style="width: 100%;" disabled>
                                                                      <i class="fas fa-check white-icon p-0"></i> Subscribed
                                                                 </button>
                                                            <?php } ?>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <br>
                    <div class="modal-content" style="border-radius: 16px !important; padding: 15px;">
                         <small>
                              helist.host
                              <b>|</b>
                              Made by <b>Clynt</b> and helist.host community 🖤
                              <b>|</b>
                         </small>
                    </div>
               </div>
          </div>
     </div>

     <div class="modal normal fade" id="domainAddModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-align-right rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Add Domain
                                   </h1><br>
                                   <small>Submit you domain.</small>
                              </div>
                         </div>
                         <p class="form-text-lines">
                              <span style="background-color: transparent !important;">Author</span>
                         </p>
                         <form method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-world white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Domain Name" name="domainAddField">
                              </div>
                              <button type="submit" class="button-big" name="submitDomain" style="width: 100%;"><i class="fas fa-send white-icon p-0"></i> Submit
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   Change nameserver to <b>dee.ns.cloudflare.com</b> and <b>everton.ns.cloudflare.com</b> before submitting your domain.
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="modal normal fade" id="usernameModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-user rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Username
                                   </h1>
                                   <small>Change your public username.</small>
                              </div>
                         </div>
                         <br>
                         <form method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-user white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="New username" name="usernameChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock white-icon p-0"></i></span>
                                   <input type="password" class="form-control icon" placeholder="Current password" name="passwordCurrentChangeField">
                              </div>
                              <button type="submit" class="button-big" name="usernameChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   3 characters minimum, 16 characters maximum
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal normal fade" id="invitesModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-key rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Inivtes
                                   </h1>
                                   <small>See your invite codes.</small>
                              </div>
                         </div>
                         <br>

                         <div class="card alert" style="margin: 0;">

                              <?php
                              $sql = "SELECT * FROM invites WHERE inviteAuthor = '$username'";
                              $result = mysqli_query($db, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   while ($row = mysqli_fetch_assoc($result)) {
                                        $code = $row["inviteCode"];
                              ?>

                                        <div class="row">
                                             <div class="col-auto">
                                                  <i class="fas fa-key white-icon p-0"></i>
                                             </div>
                                             <div class="col-auto p-0">
                                                  <span style="line-height: 1;" onclick="copy_code('https://helist.host/invite/<?php echo $code; ?>')">
                                                       <?php echo $code; ?>
                                                  </span>
                                             </div>
                                        </div>
                                        <p class="form-text-lines"></p>

                              <?php
                                   }
                              }
                              ?>

                         </div>


                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   Click invite to copy code
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal normal fade" id="embedModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-align-right rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Embed fields
                                   </h1><br>
                                   <small>Change your embed texts.</small>
                              </div>
                         </div>
                         <p class="form-text-lines">
                              <span style="background-color: transparent !important;">Author</span>
                         </p>

                         <form action="?update" method="post" name="form" enctype="multipart/form-data">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" value="<?php echo $embed['embedauthor']; ?>" name="embedauthor" id="embedauthor">
                              </div>
                              <br>
                              <p class="form-text-lines">
                                   <span style="background-color: transparent !important;">Title</span>
                              </p>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" value="<?php echo $embed['embedtitle']; ?>" name="embedtitle" id="embedtitle">
                              </div>
                              <br>
                              <p class="form-text-lines">
                                   <span style="background-color: transparent !important;">Description</span>
                              </p>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" value="<?php echo $embed['embeddesc']; ?>" name="embeddesc" id="embeddescription">
                              </div>
                              <button type="submit" class="button-big" name="button1" onclick="abfrage(this.form)" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Save
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <a style="color: white;">%username</a><a style="color: grey;"> - Displays your Username</a><br>
                                   <a style="color: white;">%filename</a><a style="color: grey;"> - Displays the Name of the uploaded File</a><br>
                                   <a style="color: white;">%filesize</a><a style="color: grey;"> - Displays the Size of the uploaded File</a><br>
                                   <a style="color: white;">%id</a><a style="color: grey;"> - Displays your User ID</a><br>
                                   <a style="color: white;">%date</a><a style="color: grey;"> - Displays the time when the File was uploaded</a><br>
                                   <a style="color: white;">%uploads</a><a style="color: grey;"> - Displays the amount of uploads you have</a>
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal normal fade" id="urlModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-align-right rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        URL Settings
                                   </h1><br>
                                   <small>Change your url settings.</small>
                              </div>
                         </div>
                         <form action="?update-settings" method="post" name="form" enctype="multipart/form-data">

                              <!-- CUSTOM DOMAIN -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" <?php echo $usecustomdomain ?> name="use_customdomain">
                                   <label class="custom-control-label" for="customCheck1">Custom Domain</label>
                              </div>

                              <!-- INVISIBLE URL -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="use_invisible_url" <?php echo $invisible_url ?>>
                                   <label class="custom-control-label" for="customCheck2">Invisible URL</label>
                              </div>

                              <!-- EMOJI URL -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="use_emoji_url" <?php echo $emoji_url ?>>
                                   <label class="custom-control-label" for="customCheck3">Emoji URL</label>
                              </div>

                              <!-- LONG FILENAME -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="filename_type" <?php echo $uselongfilename ?>>
                                   <label class="custom-control-label" for="customCheck3">Long filename</label>
                              </div>

                              <!-- RAW URL -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="url_type" <?php echo $uselongurl ?>>
                                   <label class="custom-control-label" for="customCheck3">Raw URL</label>
                              </div>

                              <!-- AMONGUS URL -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="use_sus_url" <?php echo $use_sus_url ?>>
                                   <label class="custom-control-label" for="customCheck3">AmongUs URL</label>
                              </div>

                              <!-- SELF DESTRUCT UPLOAD -->
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="self_destruct_upload" <?php echo $self_destruct_upload ?>>
                                   <label class="custom-control-label" for="customCheck3">Self destruct upload</label>
                              </div>

                              <button type="submit" class="button-big" name="button1" onclick="abfrage(this.form)" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Save
                              </button>

                         </form>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal normal fade" id="colorModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-paint-brush rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Color
                                   </h1>
                                   <small>Change your embed color.</small>
                              </div>
                         </div>
                         <form action="?update-color" method="post" name="form" enctype="multipart/form-data">
                              <div class="input-group mb-3">
                                   <input type="color" class="form-control form-control-color" value="<?php echo $embed['embedcolor']; ?>" id="colorpicker" name="colorpicker">
                              </div>
                              <button type="submit" class="button-big" name="button1" onclick="abfrage(this.form)" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Save
                              </button>
                         </form>
                    </div>
               </div>
          </div>
     </div>

     <div class="modal normal fade" id="portfolioModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-align-right rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Portfolio
                                   </h1>
                                   <small>Edit your public portfolio.</small>
                              </div>
                         </div>
                         <p class="form-text-lines">
                              <span style="background-color: transparent !important;">Status</span>
                         </p>
                         <form method="post" action="">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-signal white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" name="statusField" placeholder="<?php if (empty($status)) {
                                                                                                                        echo "No status";
                                                                                                                   } else {
                                                                                                                        echo $status;
                                                                                                                   } ?>">
                              </div>
                              <button type="submit" class="button-big" name="statusChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <br>
                         <p class="form-text-lines">
                              <span style="background-color: transparent !important;">Portfolio</span>
                         </p>
                         <form method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <textarea style="resize: none;" class="form-control icon" placeholder="<?php if (empty($description)) {
                                                                                                                   echo "No description";
                                                                                                              } else {
                                                                                                                   echo $description;
                                                                                                              } ?>" name="portfolioChangeField" rows="6"></textarea>
                              </div>
                              <button type="submit" class="button-big" name="portfolioChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   16-512 characters maximum
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal normal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-lock rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Password
                                   </h1>
                                   <small>Change your password.</small>
                              </div>
                         </div>
                         <br>
                         <form method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock white-icon p-0"></i></span>
                                   <input type="password" class="form-control icon" placeholder="New password" name="passwordChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock white-icon p-0"></i></span>
                                   <input type="password" class="form-control icon" placeholder="Current password" name="passwordCurrentChangeField">
                              </div>
                              <button type="submit" class="button-big" name="passwordChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   6 characters minimum, 64 characters maximum
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="modal normal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-user-circle rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Avatar
                                   </h1>
                                   <small>Change your avatar.</small>
                              </div>
                         </div>
                         <br>
                         <form method="post" enctype="multipart/form-data">
                              <div class="mb-3">
                                   <input class="form-control" type="file" name="avatarForm">
                              </div>
                              <button type="submit" class="button-big" name="avatarChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   .jpg, .png, .gif — 5MB maximum — 200x200 minimum, 2000x2000 maximum
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="modal normal fade" id="profileModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-user-circle rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Profile page
                                   </h1>
                                   <small>Change profile page.</small>
                              </div>
                         </div>
                         <br>
                         <form method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Modal color" name="modalColorChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Background image" name="backgorundChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Card color" name="cardColorChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Blured card color" name="bluredCardColorChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Hover color" name="hoverColorChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Modal body blured" name="bluredModalBodyChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Hr color" name="hrColorChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Badge border" name="badgeBorderChangeField">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text" id="basic-addon1"><i class="fas fa-align-right white-icon p-0"></i></span>
                                   <input type="text" class="form-control icon" placeholder="Badge background color" name="badgeColorChangeField">
                              </div>
                              <button type="submit" class="button-big" name="colorsChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   Ony .html files are allowed.
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <div class="modal normal fade" id="backgroundModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content normal">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-auto">
                                   <i class="fas fa-image rounded-icon white-icon" style="font-size: 20px; padding-top: 15px; height: 50px !important; width: 50px !important;"></i>
                              </div>
                              <div class="col-auto p-0">
                                   <h1 style="line-height: 0.8;">
                                        Background
                                   </h1>
                                   <small>Change your profile's background.</small>
                              </div>
                         </div>
                         <br>
                         <form method="post" enctype="multipart/form-data">
                              <div class="mb-3">
                                   <input class="form-control" type="file" name="backgroundForm">
                              </div>
                              <button type="submit" class="button-big" name="backgroundChange" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                              </button>
                         </form>
                         <p class="form-text-lines"></p>
                         <div class="card alert" style="margin: 0;">
                              <span>
                                   <i class="fas notice fa-exclamation white-icon p-0"></i>
                                   .jpg, .png, .gif — 15MB maximum — 500x500 minimum, 4000x4000 maximum
                              </span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</body>
<script src="https://www.paypal.com/sdk/js?client-id=Af7N-5ezlVyB1CTF9HMqDwSI55w3YjjqndxUWc8t4NAV2gtP6RwjQLcELZvwJMT3L1rxuAd9GZuv3BB3&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
     function initPayPalButton() {
          paypal.Buttons({
               style: {
                    shape: 'rect',
                    color: 'black',
                    layout: 'horizontal',
                    label: 'paypal',

               },

               createOrder: function(data, actions) {
                    return actions.order.create({
                         purchase_units: [{
                              "description": "HelistHost Lifetime",
                              "amount": {
                                   "currency_code": "USD",
                                   "value": 5
                              }
                         }]
                    });
               },

               onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                         // Full available details
                         console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                         // Show a success message within this page, e.g.
                         const element = document.getElementById('paypal-button-container');
                         element.innerHTML = '';
                         element.innerHTML = '<h3>Thank you for your payment!</h3>';
                         const paymentStatus = orderData.status;

                         $.ajax({
                              type: "POST",
                              url: "./php/updatePremium.php",
                              data: {
                                   status: paymentStatus,
                                   username: '<?php echo $_SESSION['username']; ?>'
                              },
                              success: function(data) {
                                   console.log(data);
                              }
                         });
                    });

               },

               onError: function(err) {
                    console.log(err);
               }
          }).render('#paypal-button-container');
     }
     initPayPalButton();
</script>
<script>
     function copy_code(code) {
          navigator.clipboard.writeText(code);
          notify("Invite code copied to clipboard", 1);
          $("#copy-invite-p").text("Ivite code copied");
     }
     $(".discount-box").mouseleave(function() {
          setTimeout(
               function() {
                    $("#copy-invite-p").text("Click to copy code");
               }, 150);
     });
</script>
<script>
     function download(filename, text) {
          var element = document.createElement('a');
          element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
          element.setAttribute('download', filename);

          element.style.display = 'none';
          document.body.appendChild(element);

          element.click();

          document.body.removeChild(element);
     }

     function generateConfig() {
          var text = `{
  "Version": "<?php echo SERVICE_VERSION ?>",
  "Name": "<?php echo SERVICE_NAME ?> - <?php echo $_SESSION['username']; ?>",
  "DestinationType": "ImageUploader, FileUploader",
  "RequestMethod": "POST",
  "RequestURL": "https://helist.host/api/upload",
  "Parameters": {
    "secret": "<?php echo $secret ?>",
    "use_sharex": "true"
  },
  "Body": "MultipartFormData",
  "FileFormName": "file"
}`;

          var filename = "<?php echo SERVICE_NAME ?>-<?php echo $_SESSION['username']; ?>.sxcu";
          setTimeout(() => {
               download(filename, text);
          }, 1000)
     }
</script>
<script>
     function abfrage(form) {
          if (form.confirm.checked) {

          } else {

          }
     }
</script>