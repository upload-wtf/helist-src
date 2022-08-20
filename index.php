<?php

include "./src/database.php";
include "./src/config.php";
include "./src/functions.php";

session_start();
if (isset($_SESSION['username']) && !isset($_GET['f'])) {
    header('location: ./dashboard');
}



?>
<html>
<?php
$ranPass = generateRandomInt(16);
$uuid = uuid();
$tag = generateRandomInt(4);
date_default_timezone_set('Europe/Berlin');
$date = date('F d, Y h:i:s A');

$username = '';
$errors = [];
$succeded = [];

$sql = 'SELECT * FROM users';
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$avatar = $row['avatar'];


$protocol =
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'
        ? 'https'
        : 'http' . '://';
if (isset($_GET['f'])) {
    $string = $_GET['f'];
    if (strlen($string) > 20) {
        $string = urlencode($string);
        $sql = "SELECT * FROM `uploads` WHERE `hash_filename`='$string'";
        $result = mysqli_query($db, $sql);
        $upload = mysqli_fetch_assoc($result);
        $filename = $upload['filename'];
        $type = strrchr($filename, '.');
        $type = str_replace('.', '', $type);
        $title = $upload['embed_title'];
        $description = $upload['embed_desc'];
        $author = $upload['embed_author'];
        $color = $upload['embed_color'];
        $url = $upload['embed_url'];
        $username = $upload['username'];
        $self_destruct_upload = $upload['self_destruct_upload'];
        $uploaded_at = $upload['uploaded_at'];
        $delete_secret = $upload['delete_secret'];
        $original_filename = $upload['original_filename'];
        $show_filesize = 0;
        $userquery =
            "SELECT * FROM `users` WHERE username='" . $username . "';";
        $userresult = mysqli_query($db, $userquery);
        $upload432423423 = mysqli_fetch_assoc($userresult);
        $uuid = $upload432423423['uuid'];
        $domain = $upload432423423['upload_domain'];
        $files = scandir('uploads/' . $uuid . '/' . $username);
        $sql213 = "SELECT * FROM `users` WHERE username='" . $username . "';";
        $views = $upload['views'];
        $result123 = mysqli_query($db, $sql213);
        $result1234 = mysqli_fetch_assoc($result123);
        $banned = $result1234['banned'];
        $upload_background = $result1234['upload_background'];
        $upload_background_toggle = $result1234['upload_background_toggle'];
        $useridentification = $result1234['uuid'];
        header("Location: https://i.helist.host/$filename");
        exit();
    } else {
        $type = strrchr($string, '.');
        $type = str_replace('.', '', $type);
        $sql = "SELECT * FROM `uploads` WHERE `filename`='" . $string . "';";
        $result = mysqli_query($db, $sql);
        $upload = mysqli_fetch_assoc($result);
        $filename = $upload['filename'];
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
        $userquery ="SELECT * FROM `users` WHERE username='" . $username . "';";
        $userresult = mysqli_query($db, $userquery);
        $upload432423423 = mysqli_fetch_assoc($userresult);
        $uuid = $upload432423423['uuid'];
        $anopage = $upload432423423['anonym_page'];
        $files = scandir('uploads/' . $uuid . '/' . $username);
        $sql213 = "SELECT * FROM `users` WHERE username='" . $username . "';";
        $views = $upload['views'];
        $result123 = mysqli_query($db, $sql213);
        $result1234 = mysqli_fetch_assoc($result123);
        $banned = $result1234['banned'];
        $upload_background = $result1234['upload_background'];
        $upload_background_toggle = $result1234['upload_background_toggle'];
        $useridentification = $result1234['uuid'];
    }
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'Discordbot') && $self_destruct_upload == 'true') {
        die('fuck off discord');
    } else {
        $sql =
            "UPDATE `uploads` SET views = views+1 WHERE filename='" .
            $_GET['f'] .
            "';";
        $result = mysqli_query($db, $sql);
    }
    if ($self_destruct_upload == 'true' && $views >= 2) {
        if (strpos($user_agent, 'Discordbot')) {
            die('fuck off discord');
        } else {
            unlink("/uploads/$uuid/$username/" . $filename);
            $query = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($db, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $uploads = '' . $row['uploads'] . '' - 1;
                }
            } else {
                echo '0 results';
            }
            $query2 =
                "UPDATE users SET uploads=$uploads WHERE username='" .
                $username .
                "';";
            $results2 = mysqli_query($db, $query2);
            $query43 =
                "DELETE FROM `uploads` WHERE `delete_secret`='" .
                $delete_secret .
                "';";
            $results434343 = mysqli_query($db, $query43);
            die();
        }
    }
    foreach ($files as $file) {
        if ($file == $_GET['f']) {
            $filesize = human_filesize(
                filesize(
                    'uploads/' .
                        $uuid .
                        '/' .
                        $username .
                        '/' .
                        $upload['filename']
                ),
                2
            ); ?>

               <head>

                    <title><?php echo $_GET['f']; ?></title>
                    <meta name="viewport" content="width=device-width, minimum-scale=0.1">


                    <meta property="og:site_name" content="<?php echo $author; ?>">
                    <meta property="og:title" content="<?php echo $title; ?>">
                    <meta property="og:url" content="<?php echo $url ?>">

                    <!-- PNG -->
                    <?php if (
                        $type == 'png' ||
                        $type == 'gif' ||
                        $type == 'jpeg' ||
                        $type == 'jpg'
                    ): ?>
                         <meta name="twitter:card" content="summary_large_image">
                         <meta property="og:description" content="<?php echo $description; ?>">
                         <meta property="twitter:image" content="<?php echo "/uploads/$useridentification/$username/" .
                             $filename; ?>">

                         <!-- WEBM -->
                    <?php elseif ($type == 'mp4' || $type == 'webm'): ?>
                         <meta name='twitter:card' content='player'>
                         <meta name="twitter:description" content="<?php echo $description; ?>">
                         <meta name='twitter:player' content='<?php echo "/uploads/$useridentification/$username/" .
                             $_GET['f']; ?>'>
                         <meta name='twitter:player:width' content='1920'>
                         <meta name='twitter:player:height' content='1080'>

                         <!-- ZIP -->
                    <?php elseif ($type == 'zip'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - ZIP.png'>

                         <!-- RAR -->
                    <?php elseif ($type == 'rar'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - RAR.png'>

                         <!-- TORRENT -->
                    <?php elseif ($type == 'torrent'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - U.png'>

                         <!-- EXE -->
                    <?php elseif ($type == 'exe'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - EXE.png'>

                         <!-- WAV -->
                    <?php elseif ($type == 'wav'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - WAV.png'>

                         <!-- MP3 -->
                    <?php elseif ($type == 'mp3'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - MP3.png'>

                         <!-- JS -->
                    <?php elseif ($type == 'js'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - JS.png'>

                         <!-- PYTHON -->
                    <?php elseif ($type == 'py'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - PYTHON.png'>

                         <!-- CSS -->
                    <?php elseif ($type == 'css'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - CSS.png'>

                         <!-- HTML -->
                    <?php elseif ($type == 'html'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - HTML.png'>

                         <!-- C# -->
                    <?php elseif ($type == 'cs'): ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>
                         <meta name='twitter:image' content='https://<?php echo CDN_URL; ?>/assets/images/icons/Filetype - C#.png'>


                    <?php else: ?>
                         <meta name='twitter:card' content='summary_large_image'>
                         <meta name="twitter:description" property="og:description" itemprop="description" content="<?php echo $description; ?>">
                         <meta name='twitter:title' content='<?php echo $title; ?>'>

                    <?php endif; ?>
                    <meta name="theme-color" content="<?php echo $color; ?>">
                    <meta name='og:description' content='<?php echo $description; ?>'>



               </head>
               <link rel="stylesheet" href="https://https://helist.host/assets/css/uikit.min.css" />
      <link rel="stylesheet" href="https://helist.host/assets/css/style.css" />
      <link rel="stylesheet" href="https://helist.host/assets/css/img-prw.css" />
      <script src="https://helist.host/assets/js/uikit.min.js"></script>
      <script src="https://helist.host/assets/js/uikit-icons.min.js"></script>

               </head>
               <body>
     <div id="watermark"><p1><img class="logo" src="https://helist.host/assets/img/helist-logo.png"></p1></div>
	<div class="main">
	<div class="upload">
	<a href="<?php echo "https://cdn.helist.host/uploads/$useridentification/$username/$filename"; ?>"><img class="image" src="<?php echo "https://cdn.helist.host/uploads/$useridentification/$username/$filename"; ?>"></a><br>
    <?php
        if($anopage == 'false') { ?>
        <p1 class="uploadedby" style="color: white;">Uploaded by: <?php echo $username ?></p1><br>
        <p1 class="uploadedby" style="color: white;">Filename: <?php echo $filename ?></p1>
        <?php
        } else {
        ?>
	<p1 class="uploadedby" style="color: white;">Uploaded by: ???</p1><br>
    <p1 class="uploadedby" style="color: white;">Filename: <?php echo $filename ?></p1>

    <?php } ?>
	</div>
	</div>
</body>

     <?php
        }
    }
} else {
     ?>

     <head>
          <?php if (!isset($_GET['invite'])) {
              echo "<meta name='theme-color' content='#7f26d9'>
            <meta name='og:site_name' content='https://helist.host/'>
            <meta property='og:title' content='helist.host' />
            <meta property='og:url' content='https://helist.host/' />
            <meta property='og:type' content='website' />
            <meta property='og:description' content='A Free File Uploader for all of your Files.' />
            <meta content='https://helist.host/assets/images/banner.png' property='og:image'>";
          } ?>
     </head>
     <!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
</head>

<body style="background-color: rgb(17, 16, 16);">
    <div class="flex h-screen flex-col justify-center">
        <div>
            <h1 class="text-center text-4xl text-gray-300">
                helist.host
            </h1>
            <p class="text-center text-gray-300">
                A platform for sharing and hosting your files.
            </p><br>
            <div class="text-center gap-2">
                <button
                    class="items-center rounded-lg border border-[#fcfcfc] p-1 px-3 text-lg text-gray-200 transition-all hover:border-[#535354] hover:bg-[#535354]">
                    <a href="login" class="text-white">Login</a>
                </button>
                <button
                    class="items-center rounded-lg border border-[#fcfcfc] p-1 px-3 text-lg text-gray-200 transition-all hover:border-[#535354] hover:bg-[#535354]">
                    <a href="register" class="text-white">Register</a>
                </button>
                <button class="items-center rounded-lg border border-[#2932d9] p-1 px-3 text-lg text-gray-200 transition-all hover:border-[#1925a6] hover:bg-[#1925a6]">
                    <a href="https://discord.com/invite/helist/" class="text-white">Discord</a>
                        
                </button>
            </div>
        </div>
    </div>
</body>

</html>
<?php
}
?>

</html>

</html>