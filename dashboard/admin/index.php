<?php

include "../../src/config.php";
include "../../src/database.php";
include "../../src/functions.php";

session_start();
if (!isset($_SESSION['username'])) {
     $_SESSION['msg'] = "You must log in first";
     header('location: ../');
}

$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$admin = $row['admin'];
if ($admin != 1) {
     header("location: ../");
}

if (isset($_GET['logout'])) {
     session_destroy();
     unset($_SESSION['username']);
     unset_cookie('AUTH_COOKIE');
     header("location: ../");
}

if (isset($_POST["invitewave"])) {
     $sqll = "SELECT * FROM `users`";
     $result = mysqli_query($db, $sqll);
     $rows = mysqli_num_rows($result);
     for ($i = 0; $i < $rows; $i++) {
          $row = mysqli_fetch_assoc($result);
          $inviteauthor = $row["username"];
          $invitecode = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
          $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invitecode . "', '" . $inviteauthor . "');";
          mysqli_query($db, $sql);
     }
     header("location: ../admin/");
}

if (isset($_GET["ban"])) {
     $ban_id = $_GET["ban"];
     $sql = "UPDATE `users` SET `banned`='true' WHERE `id`='$ban_id'";
     if ($result = mysqli_query($db, $sql)) {
          $sql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $sql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row54 = mysqli_fetch_array($userresult)) {
                         $username = $row54["username"];
                         $uuid = $row54["uuid"];
                    }
               }
          }
          $usersql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $usersql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row = mysqli_fetch_array($userresult)) {
                         $user_name = $row["username"];
                         $_SESSION["banmsg"] = "<div class='card' <div class='card-body'><h3 class='card-text' style='color: red;'>Banned $user_name!</h3></div><br>";
                         header("location: ../admin/");
                    }
               }
          }
     } else {
          echo "Failed to Ban User $ban_id";
     }
}
if (isset($_GET["unban"])) {
     $ban_id = $_GET["unban"];
     $sql = "UPDATE `users` SET `banned`='false' WHERE `id`='$ban_id'";
     if ($result = mysqli_query($db, $sql)) {
          $sql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $sql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row54 = mysqli_fetch_array($userresult)) {
                         $username = $row54["username"];
                         $uuid = $row54["uuid"];
                    }
               }
          }
          $usersql = "SELECT * FROM `users` WHERE `id`='$ban_id'";
          if ($userresult = mysqli_query($db, $usersql)) {
               if (mysqli_num_rows($userresult) > 0) {
                    while ($row = mysqli_fetch_array($userresult)) {
                         $user_name = $row["username"];
                         $_SESSION["banmsg"] = "<div class='card' <div class='card-body'><h3 class='card-text' style='color: green;'>Unbanned $user_name!</h3></div><br>";
                         header("location: ../admin/");
                    }
               }
          }
     } else {
          die("Failed to Un-Ban User $ban_id");
     }
     header("location: ../admin/");
}

$sql1 = "SELECT * FROM toggles;";
if ($result1 = mysqli_query($db, $sql1)) {
     if (mysqli_num_rows($result1) > 0) {
          while ($row1 = mysqli_fetch_array($result1)) {
               $maintenance = $row1["maintenance"];
               $allow_uploads = $row1["allow_uploads"];
               $invites = $row1["invites"];
          }
     } else {
          die("Not found!");
     }
}

if (isset($_POST['enable-invites'])) {
     $sql = "UPDATE toggles SET `invites`='true';";
     $result = mysqli_query($db, $sql);

     header("location: ../admin/");
}

if (isset($_POST['disable-invites'])) {
     $sql = "UPDATE toggles SET `invites`='false';";
     $result = mysqli_query($db, $sql);

     header("location: ../admin/");
}

if (isset($_POST['enable-uploads'])) {
     $sql = "UPDATE toggles SET `allow_uploads`='true';";
     $result = mysqli_query($db, $sql);

     header("location: ../admin/");
}

if (isset($_POST['disable-uploads'])) {
     $sql = "UPDATE toggles SET `allow_uploads`='false';";
     $result = mysqli_query($db, $sql);

     header("location: ../admin/");
}

if (isset($_POST['enable-maintenance'])) {
     $sql = "UPDATE toggles SET `maintenance`='true';";
     $result = mysqli_query($db, $sql);

     header("location: ../admin/");
}

if (isset($_POST['disable-maintenance'])) {
     $sql = "UPDATE toggles SET `maintenance`='false';";
     $result = mysqli_query($db, $sql);

     header("location: ../admin/");
}

?>
<!DOCTYPE HTML>
<html>

<head>
     <title><?php echo SERVICE_NAME ?> | Dashboard</title>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/dash.css">
     <link rel="stylesheet" href="https://<?php echo CDN_URL ?>/assets/css/admin.css">

     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


     <!--mdbootstrap stuff-->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>

</head>

<body>

     <nav class="navbar navbar-expand-lg text-light">
          <div class="container">
               <span class="navbar-brand mb-0 h1"><?php echo SERVICE_NAME ?></span>
               <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                         <a class="nav-link col-md-4 link-white" href="../">home</a>
                    </div>
               </div>
          </div>
     </nav>


     <div class="container mt-5">

          <!-- users list box -->
          <div class="card">
               <div class="card-body">
                    <h3 class="card-text">Users</h3>
                    <table class="table table-striped">
                         <thead>
                              <tr>
                                   <th scope="col">#</th>
                                   <th scope="col">Username</th>
                                   <th scope="col">UUID</th>
                                   <th scope="col">Banned</th>
                                   <th scope="col">Ban/Unban</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              $sql = "SELECT * FROM `users`";
                              if ($result = mysqli_query($db, $sql)) {
                                   if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                             $id = $row["id"];
                                             $username = $row["username"];
                                             $uuid = $row["uuid"];
                                             $last_login = $row["last_login"];
                                             $banned = $row["banned"];
                                             if ($banned == "true") {
                                                  $banned = "Yes";
                                             } else {
                                                  $banned = "No";
                                             }
                                             echo "<tr>";
                                             echo "<th scope='row'>" . $id . "</th>";
                                             echo "<td>" . $username . "</td>";
                                             echo "<td>" . $uuid . "</td>";
                                             echo "<td>" . $banned . "</td>";
                                             // if banned = flase then show ban button
                                             if ($banned == "No") {
                                                  echo "<td><a href='?ban=" . $id . "' class='btn btn-danger'>Ban</a></td>";
                                             } else {
                                                  echo "<td><a href='?unban=" . $id . "' class='btn btn-success'>Unban</a></td>";
                                             }
                                             echo "</tr>";
                                        }
                                   }
                              }
                              ?>
                         </tbody>
                    </table>

               </div>

               <!-- settings card -->
               <div class="card">
                    <div class="card-body">
                         <h3 class="card-text">Settings</h3>
                         <?php
                         $sql = "SELECT * FROM `toggles`";
                         $result = mysqli_query($db, $sql);
                         $row = mysqli_fetch_array($result);
                         $allow_uploads = $row["allow_uploads"];
                         $maintenance = $row["maintenance"];
                         $invites = $row["invites"];
                         if ($invites == "false") {
                         ?>
                              <form method="post">
                                   <button type="submit" name="enable-invites" class="btn btn-primary">Enable Invites</button>
                              </form><br>
                         <?php
                         } else { ?>
                              <form method="post">
                                   <button type="submit" name="disable-invites" class="btn btn-primary">Disable Invites</button>
                              </form><br>
                         <?php
                         }
                         if ($allow_uploads == "false") {
                         ?>
                              <form method="post">
                                   <button type="submit" name="enable-uploads" class="btn btn-primary">Enable Uploads</button>
                              </form><br>
                         <?php
                         } else { ?>
                              <form method="post">
                                   <button type="submit" name="disable-uploads" class="btn btn-primary">Disable Uploads</button>
                              </form><br>
                         <?php
                         }
                         if ($maintenance == "false") {
                         ?>
                              <form method="post">
                                   <button type="submit" name="enable-maintenance" class="btn btn-primary">Enable Maintenance</button>
                              </form><br>
                         <?php
                         } else { ?>
                              <form method="post">
                                   <button type="submit" name="disable-maintenance" class="btn btn-primary">Disable Maintenance</button>
                              </form>
                         <?php
                         } ?>
                    </div>
               </div>

               <div class="card">
                    <div class="card-body">
                         <h3 class="card-text">Invites</h3>
                         <form action="" method="post">
                              <div class="form-group">
                                   <label for="invite_uuid">ID</label>
                                   <input type="text" class="form-control" id="invite_id" name="invite_uuid" placeholder="ID">
                              </div>
                              <button type="submit" name="invitetouser" class="btn btn-primary">Invite</button>
                         </form><br>
                         <form method='POST' action=''><button type='submit' name='invitewave' class='btn btn-lg btn-primary'>Invitewave</button></form>
                    </div>
               </div>



          </div>
          <script src="https://<?php echo CDN_URL ?>/assets/js/loader.js" defer=""></script>
          <script>
               function abfrage(form) {
                    if (form.confirm.checked) {

                    } else {

                    }
               }
          </script>
</body>

</html>