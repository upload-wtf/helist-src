<?php

include "../src/database.php";
include "../src/config.php";
include "../src/functions.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['banned'] == 'true') {
    header('location: /logout');
}

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$uuid = $row['uuid'];
$admin = $row['admin'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Images</title>
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
                    <li><a href="/dashboard">Home</a></li>
                    <li><a href="/dashboard/settings">Settings</a></li>
                    <li><a href="/dashboard/images" style="color: white">Images</a></li>
                    <li><a href="/dashboard/mail">Mail</a></li>
                    <?php if ($admin == '1') { ?>
                    <li><a href="/dashboard/admin">Admin</a></li>
                    <?php } ?>
                    <li><a href="/dashboard/logout">Logout</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="uk-container uk-margin-top">
          <div class="uk-card uk-card-default uk-card-body">
               <h3 class="uk-card-title">Images</h3>
               <p>
                    <form method="POST" action="">
                    <button type="submit" name="wipe-files" class="uk-button uk-button-primary">Wipe Files</button>
                    <button type="submit" name="download-files" class="uk-button uk-button-primary">Download Files</button>
                    </form>
               </p>
          </div>

    <div class="uk-container uk-margin-large-top">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-match" uk-grid>
            <?php
            $sql = "SELECT * FROM uploads WHERE username = '$username'";
            $result = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $filename = $row['filename'];
                $secret = $row['delete_secret'];
                $imageurl =
                    'https://helist.host/uploads/' .
                    $uuid .
                    '/' .
                    $username .
                    '/' .
                    $filename;
                echo '<div>';
                echo '<div class="uk-card uk-card-default uk-card-body">';
                echo '<img src="' .
                    $imageurl .
                    '" alt="' .
                    $filename .
                    '" style="width: 100%; height: 70%">';
                echo '<div class="uk-card-footer">';
                echo '<a href="?delete=' .
                    $filename .
                    '&secret=' .
                    $secret .
                    '" class="uk-button uk-button-danger">Delete</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

</body>

<?php
if (isset($_GET['delete'])) {
    $delfilename = $_GET['delete'];
    if (isset($_GET['secret'])) {
        $query645 = "SELECT delete_secret FROM uploads WHERE filename='$delfilename'";
        $result645 = mysqli_query($db, $query645);
        if (mysqli_num_rows($result645) > 0) {
            while ($row645 = mysqli_fetch_assoc($result645)) {
                $delete_secret = '' . $row645['delete_secret'] . '';
            }
        } else {
        }
        if ($delete_secret == $_GET['secret']) {
            $sql =
                "DELETE FROM uploads WHERE filename='" . $_GET['delete'] . "';";
            $result = mysqli_query($db, $sql);
            unlink("./uploads/$uuid/$username/" . $_GET['delete']);
            $sql =
                "UPDATE users SET uploads=$uploads WHERE username='" .
                $username .
                "';";
            $result = mysqli_query($db, $sql);

            echo '<script>toastr.success("File deleted", "Success")</script>';

            echo "<meta http-equiv='Refresh' Content='2; url=/dashboard/images'>"; 
        }
    }
}

if (isset($_POST['wipe-files'])) {
    delete_files("../uploads/$uuid/$username");
    $sql = "UPDATE users SET uploads=0 WHERE username='$username';";
    $result = mysqli_query($db, $sql);
    $sql = "DELETE FROM uploads WHERE username='$username';";
    $result = mysqli_query($db, $sql);


    echo '<script>toastr.success("Files wiped", "Success")</script>';

    echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/images'>"; 
}

if (isset($_POST['download-files'])) {
    $zip = new ZipArchive;
    if ($zip->open($username . '_uploads.zip', ZipArchive::CREATE) === TRUE) {
        if ($handle = opendir("../uploads/$uuid/$username")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $zip->addFile("../uploads/$uuid/$username/$entry", $entry);
                }
            }
            closedir($handle);
        }
        $zip->close();
    }
    $file = $username . '_uploads.zip';
    header("Content-Description: File Transfer"); 
    header("Content-Type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename=\"". basename($file) ."\""); 
    readfile ($file);
    unlink($file);

    echo '<script>toastr.success("Files zipped", "Success")</script>';

    echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/images'>"; 
}
?>

<script>
function success(title,message){
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-bottom-left",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
	toastr.success(title,message);

}
</script>
	<script>
function warning(title,message){
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-bottom-left",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
	toastr.warning(title,message);

}
</script>
	<script>
function error(title,message){
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-bottom-left",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
	toastr.error(title,message);

}
</script>

</html>
