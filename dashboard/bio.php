<?php

include '../src/database.php';
include '../src/config.php';
include '../src/functions.php';

if (isset($_GET["user"])) {
  $user = $_GET["user"];
  $sql = "SELECT * FROM users WHERE username = '$user'";
  $avatar = $row['avatar'];
  $status = $row['status'];
  $username = $row['username'];
}

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: /');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['banned'] == 'true') {
    header('location: /logout');
}

?>


<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="utf-8">


    <title><?php echo $username ?></title>
  
  <meta name="description" content="Долбоеб">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  <script src="https://kit.fontawesome.com/c4a5e06183.js" crossorigin="anonymous"></script>
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/animate.css">
  

  <link rel="stylesheet" href="../assets/css/share.button.css">
  <link rel="stylesheet" href="../assets/css/brands.css">
  <link rel="stylesheet" href="../assets/css/skeleton-auto.css">
  <link rel="stylesheet" href="../assets/css/animations.css">

</head>
<body>

    <div class="background-container">
    <section class="parallax-background">
      <div id="object1" class="object1"></div>
      <div id="object2" class="object2"></div>
      <div id="object3" class="object3"></div>
      <div id="object4" class="object4"></div>
      <div id="object5" class="object5"></div>
      <div id="object6" class="object6"></div>
      <div id="object7" class="object7"></div>
      <div id="object8" class="object8"></div>
      <div id="object9" class="object9"></div>
      <div id="object10" class="object10"></div>
      <div id="object11" class="object11"></div>
      <div id="object12" class="object12"></div>
    </section>
    </div>

<script src="https://sber-chan.me/littlelink/js/jquery.min.js"></script>
  <div class="container">
    <div class="row">
      <div class="column" style="margin-top: 5%">
                    <img alt="avatar" class="rounded-avatar fadein" src="https://sber-chan.me/img/sber-chan.png" width="128px" height="128px" style="object-fit: cover;">
          
        <h1 class="fadein">Сбер-тян</h1>


        <center><p style="width: 50%; min-width: 300px;" class="fadein">Долбоеб</p></center>

        <div style="--delay: 1s" class="button-entrance"><a class="button button-discord button button-hover icon-hover" rel="noopener noreferrer nofollow" href="https://sber-chan.me/going/1/https://discord.com/users/979996854479646781" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\discord.svg">Discord</a></div>
            <div style="--delay: 2s" class="button-entrance"><a class="button button-default email button button-hover icon-hover" rel="noopener noreferrer nofollow" href="https://sber-chan.me/going/2/mailto:roland@scheffler.software" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\email.svg">Email</a></div>
            <div style="--delay: 3s" class="button-entrance"><a class="button button-github button button-hover icon-hover" rel="noopener noreferrer nofollow" href="https://sber-chan.me/going/3/https://github.com/r-scheffler" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\github.svg">Github</a></div>
            <div style="--delay: 4s" class="button-entrance"><a class="button button-telegram button button-hover icon-hover" rel="noopener noreferrer nofollow" href="https://sber-chan.me/going/4/https://t.me/packsoru" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\telegram.svg">Telegram</a></div>
            <div style="--delay: 5s" class="button-entrance"><a class="button button-steam button button-hover icon-hover" rel="noopener noreferrer nofollow" href="https://sber-chan.me/going/5/https://steamcommunity.com/id/packsoru" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\steam.svg">Steam</a></div>
        <div class="container">
	</section>
</a></div><br>
</div>          
      </div>
    </div>
  </div>
</body>
</html>

