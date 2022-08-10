<?php

include "./src/database.php";
include "./src/config.php";
include "./src/functions.php";

require_once './src/vendor/autoload.php';

// use PalePurple\RateLimit\RateLimit;
// use PalePurple\RateLimit\Adapter\APC as APCAdapter;
// use PalePurple\RateLimit\Adapter\Redis as RedisAdapter;
// use PalePurple\RateLimit\Adapter\Predis as PredisAdapter;
// use PalePurple\RateLimit\Adapter\Memcached as MemcachedAdapter;
// use PalePurple\RateLimit\Adapter\Stash as StashAdapter;

// $adapter = new APCAdapter();

// $rateLimit = new RateLimit('login_ratelimit', 3, 30, $adapter);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <li><a href="/register">Resgister</a></li>
                    <li><a href="/login" style="color: white">Login</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="uk-container uk-margin-medium-top uk-margin-small-bottom">
        <div class="uk-child-width-1-2@s uk-grid-small uk-flex uk-flex-center" uk-grid>
            <div>
                <div class="uk-border-rounded uk-card uk-card-default uk-card-large">
                    <div class="uk-text-center uk-card-body">
                        <span uk-icon="user"></span><b> Login</b>
                        <div class="uk-container uk-margin-medium-top credentials">
                            <form method="POST" action="">
                                <p><input type="text" name="username" placeholder="Username" required >
                                    <input type="password" name="password" placeholder="Password" required>
                                    <input type="submit" name="login" >
                                </p><br>
                                <p><span style="opacity:50%;"> Don't have an account?</span> <a href="/register">Register</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php if (isset($_POST['login'])) {
    // $id = $_SERVER['REMOTE_ADDR'];
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $errors = '';

    if (empty($username)) {
        echo '<script>toastr.error("Username is required")</script>';
    }
    if (empty($password)) {
        echo '<script>toastr.error("Password is required")</script>';
    }
    // if ($rateLimit->check($id)) {
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] == $username) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['banned'] = $user['banned'];
                $_SESSION['username'] = $username;
                $_SESSION['uploads'] = $user['uploads'];

                echo '<script>toastr.success("You are now logged in", "Success")</script>';

                header('refresh:3;url=/dashboard');
            } else {
                echo '<script>toastr.error("Wrong password or username", "Error")</script>';
            }
        } else {
            echo '<script>toastr.error("Wrong password or username", "Error")</script>';
        }
    } else {
        echo '<script>toastr.error("Wrong password or username", "Error")</script>';
    }
    // } else {
    //     $errors = 'You have been rate limited';
    // }
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
