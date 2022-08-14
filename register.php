<?php

include "./src/database.php";
include "./src/config.php";
include "./src/functions.php";
include "./src/vendor/autoload.php";


use \Detain\RateLimit\RateLimit;
use \Detain\RateLimit\Adapter\APCu as APCAdapter;
use \Detain\RateLimit\Adapter\Redis as RedisAdapter;
use \Detain\RateLimit\Adapter\Predis as PredisAdapter;
use \Detain\RateLimit\Adapter\Memcached as MemcachedAdapter;
use \Detain\RateLimit\Adapter\Stash as StashAdapter;

$adapter = new APCAdapter();
$rateLimit = new RateLimit("myratelimit", 100, 3600, $adapter);

session_start();

if (isset($_GET['invite'])) {
    $invitecode = $_GET['invite'];
    $invite = "SELECT * FROM `invites` WHERE `inviteCode`='$invitecode'";
    $result = mysqli_query($db, $invite);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['inviteCode'] = $invitecode;
        $giftAuthor = $row['inviteAuthor'];
        header('Location: https://helist.host/register');
    } else {
        die('This invite does not exist!');
    }
}

$username = "";
$errors = array();
$succeded = array();


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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
                    <li><a href="/">Home</a></li>
                    <li><a href="/register" style="color: white">Resgister</a></li>
                    <li><a href="/login" >Login</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="uk-container uk-margin-medium-top uk-margin-small-bottom">
        <div class="uk-child-width-1-2@s uk-grid-small uk-flex uk-flex-center" uk-grid>
            <div>
                <div class="uk-border-rounded uk-card uk-card-default uk-card-large">
                    <div class="uk-text-center uk-card-body">
                        <span uk-icon="user"></span><b> Register</b>
                        <div class="uk-container uk-margin-medium-top credentials">
                            <form method="POST" action="">
                                <p><input type="text" name="username" placeholder="Username" required >
                                    <input type="password" name="password" placeholder="Password" required>
                                    <input type="password" name="c_password" placeholder="Repeat password" required>
                                    <input type="text" name="key" placeholder="Invite" value="<?php echo $_SESSION["inviteCode"]; ?>" required >
                                    <input type="submit" name="reg">
                                </p><br>
                                <p><span style="opacity:50%;"> Already an account?</span> <a href="/login">Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php if (isset($_POST['reg'])) {
    $id = $_SERVER['REMOTE_ADDR'];
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $c_password = mysqli_real_escape_string($db, $_POST['c_password']);
    $key = mysqli_real_escape_string($db, $_POST['key']);
    if (empty($username)) {
        echo '<script>toastr.error("Username is required");</script>';
        $error = "Username is required";
    }
    if (empty($password)) {
        echo '<script>toastr.error("Password is required");</script>';
        $error = "Password is required";
    }
    if (empty($key)) {
        echo '<script>toastr.error("Invite is required");</script>';
        $error = "Invite is required";
    }
    if ($password != $c_password) {
        echo '<script>toastr.error("Passwords do not match");</script>';
        $error = "Passwords do not match";
    }
    if ($rateLimit->check($id)) {
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] == $username) {
            echo '<script>toastr.error("Username already exists.")</script>';
        } else {
            echo '<script>toastr.error("Username already exists.")</script>';
        }
    } else {
    }
    $query = "SELECT * FROM users WHERE invite='$key'";
    $exquery = mysqli_query($db, $query);

    if (mysqli_num_rows($exquery) > 0) {
        echo '<script>toastr.error("Invite already used by another account.")</script>';
    } else {
        $regQuery = "SELECT * FROM `invites` WHERE `inviteCode`='$key';";
        $regReq = mysqli_query($db, $regQuery);
        $regResult = mysqli_fetch_assoc($regReq);
        $inviter = $regResult['inviteAuthor'];
        if ($regResult['inviteCode'] == $key) {
            $ranPass = generateRandomInt(16);
            date_default_timezone_set('Europe/Berlin');
            $date = date('F d, Y h:i:s A');
            if (count($errors) == 0) {
                if (!file_exists('uploads/' . $uuid)) {
                    mkdir('uploads/' . $uuid, 0777, true);
                }
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (id, uuid, username, password, banned, invite, secret) VALUES (NULL, '$uuid', '$username', '$hashed_password', 'false', '$inviter', '$ranPass');";
                mysqli_query($db, $query);

                $delquery = "DELETE FROM `invites` WHERE `inviteCode` = '$key';";
                mysqli_query($db, $delquery);

                echo '<script><script>toastr.success("Successfully completed register! Please login.", "Success")</script></script>';

                echo "<meta http-equiv='Refresh' Content='2; url=/login'>";
            }
        } else {
            echo '<script><script>toastr.error("Invite code is invalid.", "Error")</script></script>';
        }
    }
    } else {
        echo '<script><script>toastr.error("You have been ratelimited.", "Error")</script></script>';
    }
} ?>

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
