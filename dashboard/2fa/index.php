<?php

include "../../src/database.php";
include "../../src/config.php";

$gauth = new GoogleAuthenticator();
session_start();

if (empty($_SESSION['username_googleauthenticator'])) {
     header("Location: ../login.php");
     exit();
}

$errors = "";

$user = $_SESSION['username_googleauthenticator'];
$user_result = "SELECT * FROM users WHERE username = '$user'";
$user_result = mysqli_query($db, $user_result);

while ($row = mysqli_fetch_array($user_result)) {
     $secret_key = $row['googleAuthCode'];
}

$google_QR_Code = $gauth->getQRCodeGoogleUrl($user, $secret_key, 'Helist');

if (isset($_POST['verify_code'])) {

     if (empty($_POST['scan_code'])) {
          $errors .= "Please enter a code";
     }


     $status_login = "";

     if (!isset($_SESSION)) {
          session_start();
     }

     $code = $_POST['scan_code'];
     $username = $_SESSION['username_googleauthenticator'];

     $user_result = "SELECT * FROM users WHERE username = '$username'";
     $user_result = mysqli_query($db, $user_result);

     while ($row = mysqli_fetch_array($user_result)) {
          $google_Code = $row['googleAuthCode'];
     }

     $checkResult = $gauth->verifyCode($google_Code, $code, 2);

     if ($checkResult) {
          session_start();
          $_SESSION["loggedin"] = true;
          $_SESSION['username'] = $username;
          $_SESSION['uploads'] = $user['uploads'];

          header("Location: ../");
     }
}

?>

</head>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>helist.host</title>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <link rel="shortcut icon" type="image/jpg" href="https://helist.host/assets/images/icon.png" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
     <link rel="stylesheet" href="../assets/css/style.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <meta property="og:title" content="helist.host" />
     <meta property="og:description" content="the image host where privacy matters" />
     <meta property="og:type" content="website" />
     <meta property="og:image" content="https://helist.host/assets/images/banner.png" />
     <meta name="theme-color" content="#7f26d9">
     <meta name="twitter:card" content="summary_large_image">
     <script>
          if (window.history.replaceState) {
               window.history.replaceState(null, null, window.location.href);
          }
     </script>
</head>

<body>
     <div class="modal no-blur show d-block" id="imageModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
               <div class="modal-body image">
                    <div class="modal-content image">
                         <div class="modal-body image">
                              <img src="./assets/images/banner.png" class="top-border-30" style="width: 100%;">

                              <div class="image-text alternative">
                                   <div class="button-group" style="max-width: 100%;">
                                        <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                             <button class="navbar-button active" id="default-tab" data-bs-toggle="tab" data-bs-target="#default" type="button" role="tab" aria-controls="true" aria-selected="true"><i class="fas fa-location-arrow white-icon p-0"></i> Welcome
                                             </button>
                                             <button class="navbar-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-sign-in-alt white-icon p-0"></i> Sign in
                                             </button>
                                             <button class="navbar-button" id="profile-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-user-plus white-icon p-0"></i> Sign up
                                             </button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="modal-content border-0">
                              <?php

                              if (!empty($errors)) {
                              ?>
                                   <div class="card alert error">
                                        <span>
                                             <i class="fas error fa-times white-icon p-0"></i> <?php echo $errors ?>
                                        </span>
                                   </div>
                                   <br>
                              <?php
                              } ?>

                              <div class="modal-body image">
                                   <div class="tab-content">
                                        <div id="default" class="tab-pane fade show active">
                                             <div class="row">
                                                  <div class="col">
                                                       <div class="header-group">
                                                            <div class="row">
                                                                 <div class="col-auto">
                                                                      <i class="fas fa-location-arrow square-icon white-icon"></i>
                                                                 </div>
                                                                 <div class="col-auto p-0">
                                                                      <h1 style="line-height: 1;">
                                                                           Welcome
                                                                      </h1><br>
                                                                      <small>to <?php echo SERVICE_NAME ?></small>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <div class="col-auto">
                                                       <a href="<?php echo DISCORD_INVITE ?>" class="button-circle navbar"><i class="fab fa-discord p-0" style="color: #e5e5e5;"></i></a>
                                                  </div>
                                             </div>
                                             <br>
                                             <div class="card message">
                                                  <span>
                                                       <h2 style="line-height: 0.9;">
                                                            2FA Login
                                                       </h2>
                                                       <small>because we love security :)</small>
                                                  </span>
                                             </div>
                                             <div class="row">
                                                  <form method="post" action="">
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user white-icon p-0"></i></span>
                                                            <input type="text" class="form-control icon" placeholder="2FA Code" id="scan_code" name="scan_code">
                                                       </div>
                                                       <button type="submit" name="verify_code" class="button-big" style="width: 100%;"><i class="fas fa-sign-in-alt white-icon p-0"></i> Sign in
                                                       </button>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</body>

</html>