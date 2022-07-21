<?php

include "./src/config.php";
include "./src/database.php";
include "./src/functions.php";

session_start();
if (isset($_SESSION["username"]) && !isset($_GET["f"])) {
     header("location: ./dashboard");
}
?>
<html>
<?php


$ranPass = generateRandomInt(16);
$uuid = uuid();
$tag = generateRandomInt(4);
date_default_timezone_set('Europe/Berlin');
$date = date("F d, Y h:i:s A");

$username = "";
$errors = array();
$succeded = array();


$sql = "SELECT * FROM toggles";
$result = mysqli_query($db, $sql);
$rows = mysqli_num_rows($result);
$invite_enable = $row["invites"];

if (isset($_POST['reg'])) {

     $username = mysqli_real_escape_string($db, $_POST['username']);
     $password = mysqli_real_escape_string($db, $_POST['password']);
     $c_password = mysqli_real_escape_string($db, $_POST['c_password']);
     $key = mysqli_real_escape_string($db, $_POST['key']);
     if (empty($username)) {
          $errors = "Username is required";
     }
     if (empty($password)) {
          $errors = "Password is required";
     }
     if (empty($key)) {
          $errors = "Invite code is requires";
     }
     if ($password != $c_password) {
          $errors = "Password do not match";
     }

     $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
     $result = mysqli_query($db, $user_check_query);
     $user = mysqli_fetch_assoc($result);

     if ($user) {
          if ($user['username'] == $username) {
               $errors = "Username already exists.";
          } else {
               $errors = "Already registered.";
          }
     } else {
     }
     $query = "SELECT * FROM users WHERE invite='$key'";
     $exquery = mysqli_query($db, $query);

     if (mysqli_num_rows($exquery) > 0) {

          $errors = "Invite is already assigned to another Account.";
     } else {
          $regQuery = "SELECT * FROM `invites` WHERE `inviteCode`='$key';";
          $regReq = mysqli_query($db, $regQuery);
          $regResult = mysqli_fetch_assoc($regReq);
          $inviter = $regResult['inviteAuthor'];
          if ($regResult['inviteCode'] == $key) {
               $delquery = "DELETE FROM `invites` WHERE `inviteCode` = '$key';";
               mysqli_query($db, $delquery);
               $ranPass = generateRandomInt(16);
               date_default_timezone_set('Europe/Berlin');
               $date = date("F d, Y h:i:s A");
               if (count($errors) == 0) {
                    if (!file_exists('../uploads/' . $uuid)) {
                         mkdir('../uploads/' . $uuid, 0777, true);
                    }
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (id, uuid, username, password, banned, invite, secret, embedcolor, embedauthor, embedtitle, embeddesc, reg_date, use_embed, use_customdomain, self_destruct_upload, filename_type, url_type, uploads, upload_domain, discord_username, discord_id, inviter, last_uploaded, upload_limit, upload_size_limit, bio_background, avatar) VALUES (NULL, '$uuid', '$username', '$hashed_password', 'false', '$invite', '$ranPass', '#7f26d9', 'helist.host', '%filename (%filesize)', 'Uploaded by %username at %date', '$date', 'true', 'true', 'false', 'false', 'short', 'short', 0, 'helist.host', 'user#0000', '$inviter', '$date', '500 MB', '32 MB', 'https://helist.host/assets/images/banner.png	', 'https://helist.host/assets/images/avatar.png	');";
                    mysqli_query($db, $query);
                    header('location: /');
               }
          } else {
               $errors = "Invite is not valid.";
          }
     }
}



if (isset($_POST['login'])) {
     $username = mysqli_real_escape_string($db, $_POST['username']);
     $password = mysqli_real_escape_string($db, $_POST['password']);

     $errors = "";

     if (empty($username)) {
          $errors = "Username is required";
     }
     if (empty($password)) {
          $errors = "Password is required";
     }

     $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
     $result = mysqli_query($db, $user_check_query);
     $user = mysqli_fetch_assoc($result);

     if ($user) {
          if ($user['username'] == $username) {
               if (password_verify($password, $user['password'])) {

                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["banned"] = $user['banned'];
                    $_SESSION['username'] = $username;
                    $_SESSION['uploads'] = $user['uploads'];

                    header("Location: ../index.php");
               } else {
                    $errors = "Password is incorrect";
               }
          } else {
               $errors = "Username is incorrect";
          }
     } else {
          $errors = "Username is incorrect";
     }
}





$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$avatar = $row['avatar'];


if (isset($_GET["invite"])) {
     $invitecode = $_GET["invite"];
     $invite = "SELECT * FROM `invites` WHERE `inviteCode`='$invitecode'";
     $result = mysqli_query($db, $invite);
     $row = mysqli_fetch_assoc($result);
     if (mysqli_num_rows($result) > 0) {
          $_SESSION["inviteCode"] = $invitecode;
          $giftAuthor = $row["inviteAuthor"];
          echo "<head>
      <meta name='theme-color' content='#7f26d9'>
      <meta name='og:site_name' content='https://helist.host/'>
      <meta property='og:title' content='helist.host | Invite Code' />
      <meta property=og:url content='https://helist.host/invite/$invitecode' />
      <meta property='og:type' content='website' />
      <meta property='og:description' content='$giftAuthor invited you to helist.host!'/>
      <meta property='og:locale' content='en_GB'/>
      <meta content='https://helist.host/images/invite.png' property='og:image'>
      </head>";
          header("Location: https://helist.host/");
     } else {
          die("This invite does not exist!");
     }
}


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http" . "://";
if (isset($_GET["f"])) {
     $string = $_GET["f"];
     if (strlen($string) > 20) {
          $string = urlencode($string);
          $sql = "SELECT * FROM `uploads` WHERE `hash_filename`='$string'";
          $result = mysqli_query($db, $sql);
          $upload = mysqli_fetch_assoc($result);
          $filename = $upload["filename"];
          $type = strrchr($filename, '.');
          $type = str_replace(".", "", $type);
          $title = $upload['embed_title'];
          $description = $upload['embed_desc'];
          $author = $upload['embed_author'];
          $color = $upload['embed_color'];
          $username = $upload['username'];
          $self_destruct_upload = $upload['self_destruct_upload'];
          $uploaded_at = $upload['uploaded_at'];
          $delete_secret = $upload['delete_secret'];
          $original_filename = $upload['original_filename'];
          $show_filesize = 0;
          $userquery = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $userresult = mysqli_query($db, $userquery);
          $upload432423423 = mysqli_fetch_assoc($userresult);
          $uuid = $upload432423423["uuid"];
          $files = scandir('uploads/' . $uuid . '/' . $username);
          $sql213 = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $views = $upload['views'];
          $result123 = mysqli_query($db, $sql213);
          $result1234 = mysqli_fetch_assoc($result123);
          $banned = $result1234["banned"];
          $upload_background = $result1234["upload_background"];
          $upload_background_toggle = $result1234["upload_background_toggle"];
          $useridentification = $result1234["uuid"];
          header("Location: https://" . DOMAIN . "/$filename");
          exit;
     } else {
          $type = strrchr($string, '.');
          $type = str_replace(".", "", $type);
          $sql = "SELECT * FROM `uploads` WHERE `filename`='" . $string . "';";
          $result = mysqli_query($db, $sql);
          $upload = mysqli_fetch_assoc($result);
          $filename = $upload["filename"];
          $title = $upload['embed_title'];
          $description = $upload['embed_desc'];
          $author = $upload['embed_author'];
          $color = $upload['embed_color'];
          $username = $upload['username'];
          $self_destruct_upload = $upload['self_destruct_upload'];
          $uploaded_at = $upload['uploaded_at'];
          $delete_secret = $upload['delete_secret'];
          $original_filename = $upload['original_filename'];
          $show_filesize = 0;
          $userquery = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $userresult = mysqli_query($db, $userquery);
          $upload432423423 = mysqli_fetch_assoc($userresult);
          $uuid = $upload432423423["uuid"];
          $files = scandir('uploads/' . $uuid . '/' . $username);
          $sql213 = "SELECT * FROM `users` WHERE username='" . $username . "';";
          $views = $upload['views'];
          $result123 = mysqli_query($db, $sql213);
          $result1234 = mysqli_fetch_assoc($result123);
          $banned = $result1234["banned"];
          $upload_background = $result1234["upload_background"];
          $upload_background_toggle = $result1234["upload_background_toggle"];
          $useridentification = $result1234["uuid"];
     }
     $user_agent = $_SERVER['HTTP_USER_AGENT'];
     if (strpos($user_agent, "Discordbot") && $self_destruct_upload == "true") {
          die("fuck off discord");
     } else {
          $sql = "UPDATE `uploads` SET views = views+1 WHERE filename='" . $_GET['f'] . "';";
          $result = mysqli_query($db, $sql);
     }
     if ($self_destruct_upload == "true" && $views >= 2) {
          if (strpos($user_agent, "Discordbot")) {
               die("fuck off discord");
          } else {
               unlink("/uploads/$uuid/$username/" . $filename);
               $query = "SELECT * FROM users WHERE username='$username'";
               $result = mysqli_query($db, $query);
               if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                         $uploads = "" . $row["uploads"] . "" - 1;
                    }
               } else {
                    echo "0 results";
               }
               $query2 = "UPDATE users SET uploads=$uploads WHERE username='" . $username . "';";
               $results2 = mysqli_query($db, $query2);
               $query43 = "DELETE FROM `uploads` WHERE `delete_secret`='" . $delete_secret . "';";
               $results434343 = mysqli_query($db, $query43);
               die();
          }
     }
     foreach ($files as $file) {
          if ($file == $_GET["f"]) {
               $filesize = human_filesize(filesize('uploads/' . $uuid . '/' . $username . "/" . $upload["filename"]), 2);

?>

               <head>

                    <title><?php echo $_GET["f"]; ?></title>
                    <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/cdn.css">
                    <meta charset="UTF-8">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
                    <link rel="stylesheet" href="./assets/css/style.css">
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <meta name="viewport" content="width=device-width, minimum-scale=0.1">


                    <meta property="og:site_name" content="<?php echo $author; ?>">
                    <meta property="og:title" content="<?php echo $title; ?>">

                    <!-- PNG -->
                    <?php if ($type == "png" || $type == "gif" || $type == "jpeg" || $type == "jpg") : ?>
                         <meta name="twitter:card" content="summary_large_image">
                         <meta property="og:description" content="<?php echo $description; ?>">
                         <meta property="twitter:image" content="<?php echo "/uploads/$useridentification/$username/" . $filename; ?>">

                         <!-- WEBM -->
                    <?php elseif ($type == "mp4" || $type == "webm") : ?>
                         <meta name='twitter:card' content='player'>
                         <meta name="twitter:description" content="<?php echo $description; ?>">
                         <meta name='twitter:player' content='<?php echo "/uploads/$useridentification/$username/" . $_GET["f"]; ?>'>
                         <meta name='twitter:player:width' content='1920'>
                         <meta name='twitter:player:height' content='1080'>

                         <!-- ZIP -->
                    <?php elseif ($type == "zip") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - ZIP.png'>

                         <!-- RAR -->
                    <?php elseif ($type == "rar") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - RAR.png'>

                         <!-- TORRENT -->
                    <?php elseif ($type == "torrent") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - U.png'>

                         <!-- EXE -->
                    <?php elseif ($type == "exe") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - EXE.png'>

                         <!-- WAV -->
                    <?php elseif ($type == "wav") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - WAV.png'>

                         <!-- MP3 -->
                    <?php elseif ($type == "mp3") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - MP3.png'>

                         <!-- JS -->
                    <?php elseif ($type == "js") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - JS.png'>

                         <!-- PYTHON -->
                    <?php elseif ($type == "py") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - PYTHON.png'>

                         <!-- CSS -->
                    <?php elseif ($type == "css") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - CSS.png'>

                         <!-- HTML -->
                    <?php elseif ($type == "html") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - HTML.png'>

                         <!-- C# -->
                    <?php elseif ($type == "cs") : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL ?>/assets/images/icons/Filetype - C#.png'>


                    <?php else : ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>

                    <?php endif; ?>
                    <meta name="theme-color" content="<?php echo $color; ?>">
                    <meta name='og:description' content='<?php echo $description; ?>'>



               </head>

               <div class="modal no-blur show d-block" id="imageModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                         <div class="modal-body image">
                              <div class="modal-content image">
                                   <div class="modal-content" style="border-radius: 32px 32px 0px 0px; padding: 0;">
                                        <img src="<?php echo "/uploads/$useridentification/$username/$filename"; ?>" style="width: 100%; height: 100%; max-height: 480px; max-width: 960px; border-radius: 32px 32px 0px 0px;">

                                        <div class="image-text alternative">
                                             <a href="https://helist.host/bio/<?php echo $username ?>">
                                                  <div class="card blurred hover" style="margin-left: 25px; margin-right: 25px; bottom: -50px; z-index: 1000;">
                                                       <div class="row">
                                                            <div class="col-auto">
                                                                 <img src="<?php echo $avatar ?>" style="border-radius: 50%; height: 60px; width: 60px; object-fit: cover;">
                                                            </div>
                                                       </div>
                                                  </div>
                                             </a>
                                        </div>
                                   </div>
                                   <div class="modal-content border-0" style="max-width: 100%;">
                                        <br>
                                        <div class="row">
                                             <div class="col-6">
                                                  <a href="<?php echo "/uploads/$useridentification/$username/$filename"; ?>" download>
                                                       <button type="submit" class="button-big" style="width: 100%;"><i class="fas fa-download white-icon p-0"></i> Download
                                                       </button>
                                                  </a>
                                             </div>
                                             <div class="col-6">
                                                  <a href="<?php echo "/uploads/$useridentification/$username/$filename"; ?>">
                                                       <button type="submit" class="button-big" style="width: 100%;"><i class="fas fa-external-link-alt white-icon p-0"></i> Open raw image
                                                       </button>
                                                  </a>
                                             </div>
                                        </div>
                                        <br>
                                        <h1 style="line-height: 1;">
                                             <?php echo $filename ?>
                                        </h1><br>
                                        <small><?php echo "Uploaded by: $username at $uploaded_at"; ?></small>
                                   </div>
                                   <br>
                              </div>
                         </div>
                    </div>
               </div>
               </body>

     <?php
          }
     }
} else { ?>

     <head>
          <?php
          if (!isset($_GET["invite"])) {
               echo "<meta name='theme-color' content='#7f26d9'>
            <meta name='og:site_name' content='https://helist.host/'>
            <meta property='og:title' content='helist.host' />
            <meta property='og:url' content='https://helist.host/' />
            <meta property='og:type' content='website' />
            <meta property='og:description' content='A Free File Uploader for all of your Files.' />
            <meta content='https://helist.host/assets/images/banner.png' property='og:image'>";
          }
          ?>
     </head>
     <!DOCTYPE html>
     <html lang="en">

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
          <div class="modal no-blur show d-block" id="imageModal" tabindex="-1" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
                    <div class="modal-body image">
                         <div class="modal-content image">
                              <div class="modal-body image">
                                   <img src="./assets/images/banner.png" class="top-border-30" style="width: 100%;">

                                   <div class="image-text alternative">
                                        <div class="button-group" style="max-width: 100%;">
                                             <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                                  <button class="navbar-button active" id="default-tab" data-bs-toggle="tab" data-bs-target="#default" type="button" role="tab" aria-controls="true" aria-selected="true"><i class="fas fa-location-arrow white-icon p-0"></i> Welcome
                                                  </button>
                                                  <button class="navbar-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-sign-in-alt white-icon p-0"></i> Sign in
                                                  </button>
                                                  <button class="navbar-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-plus white-icon p-0"></i> Sign up
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-content border-0">
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

                                   <div class="modal-body image">
                                        <div class="tab-content">
                                             <div id="default" class="tab-pane fade show active">
                                                  <div class="row">
                                                       <div class="col">
                                                            <div class="header-group">
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-location-arrow square-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h1 style="line-height: 1;">
                                                                                Welcome
                                                                           </h1><br>
                                                                           <small>to <?php echo SERVICE_NAME ?></small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-auto">
                                                            <a href="<?php echo DISCORD_INVITE ?>" class="button-circle navbar"><i class="fab fa-discord p-0" style="color: #e5e5e5;"></i></a>
                                                       </div>
                                                  </div>
                                                  <br>
                                                  <div class="card message">
                                                       <span>
                                                            <h2 style="line-height: 0.9;">
                                                                 The private image host
                                                            </h2>
                                                            <small>where privacy matters.</small>
                                                       </span>
                                                  </div>
                                                  <div class="row">
                                                       <div class="col" style="padding-right: 0;">
                                                            <div class="card message">
                                                                 <span>
                                                                      <?php
                                                                      $sql = "SELECT COUNT(*) FROM users";
                                                                      $result = mysqli_query($db, $sql);
                                                                      $row = mysqli_fetch_array($result);
                                                                      $users = $row[0];
                                                                      ?>
                                                                      <h1 style="line-height: 0.9;">
                                                                           <?php echo $users ?>
                                                                      </h1>
                                                                      <small>members</small>
                                                                 </span>
                                                            </div>
                                                       </div>
                                                       <div class="col" style="padding-left: 0;">
                                                            <div class="card message">
                                                                 <span>
                                                                      <?php
                                                                      $sql = "SELECT COUNT(*) FROM domains";
                                                                      $result = mysqli_query($db, $sql);
                                                                      $row = mysqli_fetch_array($result);
                                                                      $domains = $row[0];

                                                                      ?>
                                                                      <h1 style="line-height: 0.9;">
                                                                           <?php echo $domains ?>
                                                                      </h1>
                                                                      <small>domains</small>
                                                                 </span>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div id="signin" class="tab-pane fade">
                                                  <div class="row">
                                                       <div class="col">
                                                            <div class="header-group">
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-sign-in-alt square-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h1 style="line-height: 1;">
                                                                                Sign in
                                                                           </h1><br><br>
                                                                           <small>to <?php echo SERVICE_NAME ?></small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-auto">
                                                            <a href="<?php echo DISCORD_INVITE ?>" class="button-circle navbar"><i class="fab fa-discord p-0" style="color: #e5e5e5;"></i></a>
                                                       </div>
                                                  </div>
                                                  <br>
                                                  <div id="login" class="tab-pane fade show active">
                                                       <form method="post" action="">
                                                            <div class="input-group mb-3">
                                                                 <span class="input-group-text" id="basic-addon1"><i class="fas fa-user white-icon p-0"></i></span>
                                                                 <input type="text" class="form-control icon" placeholder="Username" name="username">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                 <span class="input-group-text" id="basic-addon1"><i class="fas fa-key white-icon p-0"></i></span>
                                                                 <input type="password" class="form-control icon" placeholder="Password" name="password">
                                                            </div>
                                                            <button type="submit" name="login" class="button-big" style="width: 100%;"><i class="fas fa-sign-in-alt white-icon p-0"></i> Sign in
                                                            </button>
                                                       </form>
                                                  </div>
                                             </div>
                                             <div id="signup" class="tab-pane fade">
                                                  <div class="row">
                                                       <div class="col">
                                                            <div class="header-group">
                                                                 <div class="row">
                                                                      <div class="col-auto">
                                                                           <i class="fas fa-user-plus square-icon white-icon"></i>
                                                                      </div>
                                                                      <div class="col-auto p-0">
                                                                           <h1 style="line-height: 1;">
                                                                                Sign up
                                                                           </h1><br><br>
                                                                           <small>to <?php echo SERVICE_NAME ?></small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-auto">
                                                            <a href="<?php echo DISCORD_INVITE ?>" class="button-circle navbar"><i class="fab fa-discord p-0" style="color: #e5e5e5;"></i></a>
                                                       </div>
                                                  </div>
                                                  <br>
                                                  <form method="post" action="">
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user white-icon p-0"></i></span>
                                                            <input type="text" class="form-control icon" placeholder="Username" name="username">
                                                       </div>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key white-icon p-0"></i></span>
                                                            <input type="password" class="form-control icon" placeholder="Password" name="password">
                                                       </div>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key white-icon p-0"></i></span>
                                                            <input type="password" class="form-control icon" placeholder="Repeat password" name="c_password">
                                                       </div>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock white-icon p-0"></i></span>
                                                            <input type="text" class="form-control icon" placeholder="Invite code" value="<?php echo $_SESSION["inviteCode"]; ?>" name="key">
                                                       </div>
                                                       <button type="submit" class="button-big" name="reg" style="width: 100%;"><i class="fas fa-sign-in-alt white-icon p-0"></i> Sign up
                                                       </button>
                                                       <p class="form-text-lines">
                                                            <span>With registration,</span>
                                                       </p>
                                                       <div class="card alert notice">
                                                            <span>
                                                                 <i class="fas fa-exclamation white-icon p-0"></i> You agree to our Privacy Policy and Terms Of Service on our Discord server.
                                                            </span>
                                                       </div>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </body>

     </html>
<?php
}
?>

</html>