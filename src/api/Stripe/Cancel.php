<?php

include '../database.php';
include '../config.php';
include '../functions.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: /');
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
$id = $embed['id'];
$uuid = $embed['uuid'];
$regdate = $embed['reg_date'];
$uploads = $embed['uploads'];
$banner = $row['bio_background'];
$username = $row['username'];
$status = $row['status'];
$description = $row['description'];
$premium = $row['premium'];
$admin = $row['admin'];
$custom_domain = $row['use_customdomain'];



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://https://helist.host/assets/css/uikit.min.css" />
      <link rel="stylesheet" href="https://helist.host/assets/css/style.css" />
      <script src="https://helist.host/assets/js/uikit.min.js"></script>
      <script src="https://helist.host/assets/js/uikit-icons.min.js"></script>
      <link rel="icon" type="image/png" href="https://helist.host/assets/img/helist-logo.png">
      <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    </head>
    <body>
    <div class="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
        <nav class="uk-navbar-container uk-margin" uk-navbar="mode: click">
            <div class="uk-navbar-left">
                <a href="/" class="uk-navbar-item uk-logo"><img src="https://helist.host/assets/img/helist-logo.png" alt="Logo" style="height: 2em; -moz-user-select: none;" draggable="false"></a>
                <ul class="uk-navbar-nav">
                    <li><a href="/dashboard" style="color: white">Home</a></li>
                    <li><a href="/dashboard/settings">Settings</a></li>
                    <li><a href="/dashboard/images">Images</a></li>
                    <li><a href="/dashboard/mail">Mail</a></li>
                    <li><a href="#modal-invites" uk-toggle>Invites</a></li>
                    <?php if ($admin == '1') { ?>
                    <li><a href="/dashboard/admin">Admin</a></li>
                    <?php } ?>
                    <li><a href="/dashboard/logout">Logout</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="uk-container uk-container-center">
        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-text-center">
                    <h3 class="uk-heading-line uk-text-center"><span>Welcome, <?php echo $_SESSION[
                        'username'
                    ]; ?></span></h3>
                </div>
            </div>
        </section>
    </div><br>
        <div class="uk-container">
            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Uploads</h3>
                        <p>
                            <?php echo $uploads; ?>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Storage used</h3>
                        <p><?php
                        $totalfillessize = human_filesize(
                            GetDirectorySize("../uploads/$uuid/$username"),
                            2
                        );
                        echo $totalfillessize;
                        ?>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">UID</h3>
                        <p>
                            <?php echo $id; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
