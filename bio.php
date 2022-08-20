<?php

include "./src/database.php";
include "./src/config.php";
include "./src/functions.php";

if (isset($_GET["user"])) {
    $user = $_GET["user"];
    $sql = "SELECT * FROM users WHERE username = '$user'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $avatar = $row['avatar'];
    $username = $row['username'];
    $discord_bio = $row['discord_bio'];
    $email_bio = $row['email_bio'];
    $github_bio = $row['github_bio'];
    $telegram_bio = $row['telegram_bio'];
    $steam_bio = $row['steam_bio'];
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
    <link rel="stylesheet" href="./assets/css/normalize.css">
    <link rel="stylesheet" href="./assets/css/animate.css">


    <link rel="stylesheet" href="./assets/css/share.button.css">
    <link rel="stylesheet" href="./assets/css/brands.css">
    <link rel="stylesheet" href="./assets/css/skeleton-auto.css">
    <link rel="stylesheet" href="./assets/css/animations.css">

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
                <img alt="avatar" class="rounded-avatar fadein" src="<?php echo $avatar ?>" width="128px" height="128px" style="object-fit: cover;">

                <h1 class="fadein"><?php echo $username ?></h1>
                <?php
                if ($discord_bio != "") {
                echo '<div style="--delay: 1s" class="button-entrance"><a class="button button-discord button button-hover icon-hover" rel="noopener noreferrer nofollow" href="' . $discord_bio . '" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\discord.svg">Discord</a></div>';
                } if ($email_bio != "") {
                echo '<div style="--delay: 2s" class="button-entrance"><a class="button button-default email button button-hover icon-hover" rel="noopener noreferrer nofollow" href="' . $email_bio . '" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\email.svg">Email</a></div>';
                } if ($github_bio != "") {
                echo '<div style="--delay: 3s" class="button-entrance"><a class="button button-github button button-hover icon-hover" rel="noopener noreferrer nofollow" href="' . $github_bio . '" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\github.svg">Github</a></div>';
                } if ($telegram_bio != "") {
                echo '<div style="--delay: 4s" class="button-entrance"><a class="button button-telegram button button-hover icon-hover" rel="noopener noreferrer nofollow" href="' . $telegram_bio . '" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\telegram.svg">Telegram</a></div>';
                } if ($steam_bio != "") {
                echo '<div style="--delay: 5s" class="button-entrance"><a class="button button-steam button button-hover icon-hover" rel="noopener noreferrer nofollow" href="' . $steam_bio . '" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\steam.svg">Steam</a></div>';
                } else {
                }
                ?>
                <div class="container">
                    </section>
                    </a></div><br>
            </div>
        </div>
    </div>
    </div>
</body>

</html>