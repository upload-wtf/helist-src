<?php

include '../../src/database.php';
include '../../src/config.php';
include '../../src/functions.php';

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
                    <li><a href="/dashboard/admin/">Admin Home</a></li>
                    <li><a href="/dashboard/admin/users" style="color: white">Users</a></li>
                    <li><a href="/dashboard/admin/invites">Invites</a></li>
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
    
    <!-- create a table with all users from database -->
     <div class="uk-container uk-container-center">
          <!-- users table -->
          <table class="uk-table uk-table-striped">
               <thead>
                    <tr>
                         <th>Username</th>
                         <th>Email</th>
                         <th>Admin</th>
                         <th>Banned</th>
                         <th>Created</th>
                         <th>Invited By</th>
                         <th>Actions</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    $sql = 'SELECT * FROM users;';
                    $result = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        if ($row['admin'] == 1) {
                            echo '<td>Yes</td>';
                        } else {
                            echo '<td>No</td>';
                        }
                        if ($row['banned'] == 'true') {
                            echo '<td>Yes</td>';
                        } else {
                            echo '<td>No</td>';
                        }
                        echo '<td>' . $row['created'] . '</td>';
                        echo '<td>' . $row['inviter'] . '</td>';
                        echo '<td>';
                        echo '<form action="" method="POST">';
                        echo '</form>';
                        echo '</tr>';
                    }
                    ?>
               </tbody>

    </div>
</body>

<?php

if (isset($_POST['ban'])) {
    $user = $_POST['username'];

    $sql = "SELECT * FROM users WHERE user='$user';";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['username'] == 'Clynt' || $row['id'] == '1') {
        echo "<script>
          toastr.success('Cannot ban  the site owner bruh', 'Error');
          </script>";
    } else {
        $sql = "UPDATE users SET banned='true' WHERE username='$user';";
        $result = mysqli_query($db, $sql);
        if ($result) {
            echo "<script>
          toastr.success('User banned.', 'Success');
          </script>";
            echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
        } else {
            echo "<script>
          toastr.error('Error banning user.', 'Error');
          </script>";

            echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
        }
        echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
    }
    echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
}

if (isset($_POST['unban'])) {
    $user = $_POST['username'];
    $sql = "UPDATE users SET banned='false' WHERE id='$user';";
    $result = mysqli_query($db, $sql);
    if ($result) {
        echo "<script>
          toastr.success('User unbanned.', 'Success');
          </script>";
        echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
    } else {
        echo "<script>
          toastr.error('Error unbanning user.', 'Error');
          </script>";

        echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
    }
    echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
}

if (isset($_POST['setadmin'])) {
    $user = $_POST['username'];
    $sql = "UPDATE users SET admin='1' WHERE id='$user';";
    $result = mysqli_query($db, $sql);
    if ($result) {
        echo "<script>
          toastr.success('User set as admin.', 'Success');
          </script>";
        echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
    } else {
        echo "<script>
          toastr.error('Error setting user as admin.', 'Error');
          </script>";

        echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
    }
    echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
}

if (isset($_POST['removeadmin'])) {
    $user = $_POST['username'];
    $sql = "SELECT * FROM users WHERE id='$user';";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['username'] == 'Clynt' || $row['id'] == '1') {
        echo "<script>
          toastr.success('Cannot remove admin from the site owner bruh', 'Error');
          </script>";
    } else {
        $sql = "UPDATE users SET admin='0' WHERE id='$user';";
        $result = mysqli_query($db, $sql);
        if ($result) {
            echo "<script>
          toastr.success('User removed from admin.', 'Success');
          </script>";
            echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
        } else {
            echo "<script>
          toastr.error('Error removing user from admin.', 'Error');
          </script>";

            echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
        }
        echo "<meta http-equiv='Refresh' Content='2; url=../admin/users'>";
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
