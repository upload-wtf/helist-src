<?php

include "../../src/database.php";
include "../../src/config.php";
include "../../src/functions.php";

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: /');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['admin'] == 0) {
    header('location: ../');
    exit();
}

if ($row['banned'] == 'true') {
    header('location: /logout');
}

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
                    <li><a href="../">Home</a></li>
                    <li><a href="/dashboard/admin/" >Admin Home</a></li>
                    <li><a href="/dashboard/admin/users">Users</a></li>
                    <li><a href="/dashboard/admin/invites" style="color: white">Invites</a></li>
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

    <div class="uk-container uk-margin-top">
          <div class="uk-card uk-card-default uk-card-body">
               <h3 class="uk-card-title">Images</h3>
               <p>
                    <form method="POST" action="">
                    <button type="submit" name="invite-wave" class="uk-button uk-button-primary">Invite Wave</button>
                    <button type="submit" name="delete-invs" class="uk-button uk-button-primary">Delete invites</button>
                    </form>
               </p>
          </div>

    </div>
</body>

<?php

if(isset($_POST["invite-wave"])) {

$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);
$rows = mysqli_num_rows($result);

for($i = 0; $i < $rows; $i++) {
     $row = mysqli_fetch_assoc($result);
     $username = $row['username'];
     $invitecode = ranCode(8) . "-" . ranCode(8);
     $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invitecode . "', '" . $inviteauthor . "');";
     $result = mysqli_query($db, $sql);
     if ($result) {
          echo "<script>
          toastr.success('Invite wave generated', 'Success');
          </script>";
          echo "<meta http-equiv='Refresh' Content='2; url=../admin/settings'>";
     } else {
          echo "<script>
          toastr.error('Error', 'Error');
          </script>";
          echo "<meta http-equiv='Refresh' Content='2; url=../admin/settings'>";
     }
     echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
}

}

if(isset($_POST["delete-invs"])) {
    
$sql = "DELETE FROM invites";
$result = mysqli_query($db, $sql);
if ($result) {
     echo "<script>
     toastr.success('Invites deleted', 'Success');
     </script>";
     echo "<meta http-equiv='Refresh' Content='2; url=../admin/settings'>";
} else {
     echo "<script>
     toastr.error('Error', 'Error');
     </script>";
     echo "<meta http-equiv='Refresh' Content='2; url=../admin/settings'>";
}
echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
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
