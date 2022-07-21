<?php

include "../src/config.php";
include "../src/database.php";
include "../src/functions.php";

if (isset($_GET["user"])) {
     $user = $_GET["user"];
     $sql = "SELECT * FROM users WHERE username = '$user'";
     $result = mysqli_query($db, $sql);
     $row = mysqli_fetch_assoc($result);
     $avatar = $row['avatar'];
     $banner = $row['bio_background'];
     $username = $row['username'];
     $admin = $row['admin'];
     $status = $row['status'];
     $premium = $row['premium'];
     $description = $row['description'];
     $color = $row['embedcolor'];
     $custom_profile = $row['custom_profile_theme_enable'];
     $modal_color = $row['modal_color'];
     $back_background = $row['back_background'];
     $card_color = $row['card_color'];
     $card_blured_color = $row['card_blured_color'];
     $hover_color = $row['hover_color'];
     $modal_body_blured = $row['modal_body_blured'];
     $hr_color = $row['hr_color'];
     $badge_border = $row['badge_border'];
     $badge_background_color = $row['badge_background_color'];
     if ($admin == 1) {
          $admin = "Admin";
     } else {
          $admin = "User";
     }
     if ($premium == 1) {
          $premium = "Premium";
     } else {
          $premium = "Free";
     }
     $sql = "UPDATE users SET uploads=$uploads WHERE username='" . $username . "';";
     $result = mysqli_query($db, $sql);
}

if ($custom_profile == "false") {

?>


     <!DOCTYPE html>
     <html lang="en">

     <head>
          <meta charset="UTF-8">
          <title>helist.host</title>
          <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
          <link rel="shortcut icon" type="image/jpg" href="http://assets.stickpng.com/thumbs/5a5a8d8d14d8c4188e0b08ef.png" />
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
          <link rel="stylesheet" href="../assets/css/style.css">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <meta property="og:title" content="<?php echo $username ?>'s portfolio" />
          <meta property="og:type" content="website" />
          <meta property="og:image" content="<?php echo $banner ?>" />
          <meta property="og:description" content="See <?php echo $username ?>'s portfolio" />
          <meta name="theme-color" content="<?php echo $color ?>">
          <meta name="twitter:card" content="summary_large_image">
          <script>
               if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
               }
          </script>
     </head>

     <body>
          <div class="modal no-blur show d-block" id="imageModal" tabindex="-1" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" style="max-width: 960px;">
                    <div class="modal-body image">
                         <div class="modal-content image">
                              <div class="modal-content" style="border-radius: 32px 32px 0px 0px; padding: 0;">
                                   <img src="<?php echo $banner ?>" style="width: 100%; height: 100%; border-radius: 32px 32px 0px 0px;">

                                   <div class="image-text alternative">
                                        <div class="card blurred" style="margin-left: 25px; margin-right: 25px; bottom: -50px; z-index: 1000;">
                                             <div class="row">
                                                  <div class="col-auto">
                                                       <img src="<?php echo $avatar ?>" style="border-radius: 50%; height: 60px; width: 60px; object-fit: cover;">
                                                  </div>
                                                  <div class="col-auto p-0">
                                                       <h1 style="line-height: 1;">
                                                            <?php echo $username; ?>
                                                            <?php if ($admin == "Admin") { ?>
                                                                 <span class="badge bg-secondary" style="border: none !important; font-size: 12px;"><i class="fas fa-user-cog p-0 white-icon"></i> Staff</span>
                                                            <?php } else { ?>
                                                                 <span class="badge bg-secondary" style="border: none !important; font-size: 12px;"><i class="fas fa-user p-0 white-icon"></i> Member</span>
                                                            <?php } ?>
                                                            <!-- <span class="badge bg-secondary" style="border: none !important; font-size: 12px;"><i class="fas fa-user-check p-0 white-icon"></i> Premium</span> -->
                                                       </h1>
                                                       <small style="line-height: 0.5 !important;">
                                                            <?php if ($status == "") { ?>
                                                                 <i style="padding: 0; color: #cccccc;">Hasn't set his status yet.</i>
                                                            <?php } else { ?>
                                                                 <i style="padding: 0; color: #cccccc;"><?php echo $status ?></i>
                                                            <?php } ?>
                                                       </small>
                                                       <br>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-content border-0" style="max-width: 100%;">
                                   <br>
                                   <?php if ($description == "") { ?>
                                        <h1><?php echo $username ?>'s portfolio</h1>
                                        is empty now. <?php echo $username ?> has to set some text.
                                   <?php } else { ?>
                                        <?php echo $description ?>
                                   <?php } ?>
                              </div>
                              <br>
                              <div class="modal-content" style="border-radius: 16px !important; padding: 15px;">
                                   <small>
                                        helist.host
                                        <b>|</b>
                                        Made by <b>Clynt</b> and helist.host community 🖤
                                        <b>|</b>
                                   </small>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </body>

     </html>

<?php } else {

?>


     <!DOCTYPE html>
     <html lang="en">

     <head>
          <meta charset="UTF-8">
          <title>helist.host</title>
          <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
          <link rel="shortcut icon" type="image/jpg" href="http://assets.stickpng.com/thumbs/5a5a8d8d14d8c4188e0b08ef.png" />
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
          <link rel="stylesheet" href="../assets/css/style.css">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <meta property="og:title" content="<?php echo $username ?>'s portfolio" />
          <meta property="og:type" content="website" />
          <meta property="og:image" content="<?php echo $banner ?>" />
          <meta property="og:description" content="See <?php echo $username ?>'s portfolio" />
          <meta name="theme-color" content="<?php echo $color ?>">
          <meta name="twitter:card" content="summary_large_image">
          <style>
               @import url('https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap');

               @font-face {
                    font-family: regular;
                    src: url(https://c-cloud.rocks/assets/fonts/regular.woff2);
               }

               @font-face {
                    font-family: bold;
                    src: url(https://c-cloud.rocks/assets/fonts/bold.woff2);
               }

               ::-webkit-scrollbar {
                    display: none;
               }

               ::placeholder {
                    color: #cccccc !important;
               }

               html,
               body {
                    max-width: 100vw;
                    height: 100vh;
                    font-family: regular !important;
                    background-image: url('<?php echo $back_background ?>');
                    background-size: cover;
                    background-attachment: fixed;
                    color: white;
               }

               small {
                    color: #cccccc;
                    font-weight: 300 !important;
                    font-size: 12px;
               }

               h1 {
                    margin: 0 !important;
                    font-size: 30px;
                    font-weight: 600 !important;
               }

               h2 {
                    margin: 0 !important;
                    font-size: 20px;
                    font-weight: 600 !important;
               }

               span {
                    font-size: 12px;
                    font-weight: 200 !important;
               }

               span.small {
                    font-size: 12px;
                    font-weight: 200 !important;
               }


               .p-0 {
                    padding-right: 5px !important;
               }


               .card {
                    border: 0;
                    padding: 15px;
                    margin: 5px;
                    backdrop-filter: blur(10px) !important;
                    background-color: <?php echo $card_color ?>;
                    border-radius: 32px;
                    color: white;
               }

               .card.message {
                    transition: 0.3s;
                    font-size: 12px;
                    border: 0;
                    padding: 15px;
                    margin: 5px;
                    backdrop-filter: blur(10px) !important;
                    background-color: #131313;
                    border-radius: 16px;
                    color: white;
               }

               .card.blurred {
                    background-color: <?php echo $card__blured_color ?>;
                    backdrop-filter: blur(10px) !important;
                    border-radius: 32px;
               }

               .card.group {
                    width: auto;
                    border: 0;
                    padding: 2px;
                    backdrop-filter: blur(10px) !important;
                    background-color: #1b1b1b;
                    border-radius: 8px;
                    color: white;
               }


               .image-text {
                    position: absolute;
                    bottom: 5px;
                    left: 25px;
               }

               .image-text.alternative {
                    position: absolute;
                    bottom: 10px;
                    left: 20px;
                    right: 20px;
               }

               .badge {
                    vertical-align: middle;
                    text-align: center;
                    color: white !important;
                    border: 1px solid <?php echo $badge_border ?> !important;
                    border-radius: 10px;
                    font-size: 15px;
                    font-weight: 200;
                    padding: 3px 15px;
                    background-color: <?php echo $badge_background_color ?> !important;
                    margin: 2px;
               }
               .imageDiv {
                    border-top-left-radius: 32px;
                    border-top-right-radius: 32px;
                    padding: 0 !important;
                    margin: 0 !important;
                    max-width: 100%;
                    max-height: 100%;
               }

               .avatar {
                    transition: 0.2s ease-in-out;
               }

               .avatar:hover {
                    transform: scale(1.05);
               }

               .hover:hover {
                    background-color: <?php echo $hover_color ?> !important;
               }

               .modal-content {
                    padding: 25px;
                    border-radius: 0px 0px 32px 32px;
                    border: 0;
                    background-color: <?php echo $modal_color; ?>;
               }

               .modal.normal {
                    background: transparent !important;
                    backdrop-filter: blur(25px) !important;
               }

               .modal.fade {
                    background: transparent !important;
                    backdrop-filter: blur(50px);
               }

               .modal.no-blur {
                    background: transparent !important;
               }

               .font-monospace {
                    font-weight: 200 !important;
                    font-size: 12px !important;
               }


               .modal.normal.fade .modal-dialog {
                    -webkit-transform: scale(0.1);
                    -moz-transform: scale(0.1);
                    -ms-transform: scale(0.1);
                    transform: scale(0.1);
                    top: 300px;
                    opacity: 0;
                    -webkit-transition: all 0.3s;
                    -moz-transition: all 0.3s;
                    transition: all 0.3s;
               }

               .modal.normal.fade.show .modal-dialog {
                    -webkit-transform: scale(1);
                    -moz-transform: scale(1);
                    -ms-transform: scale(1);
                    transform: scale(1);
                    -webkit-transform: translate3d(0, -300px, 0);
                    transform: translate3d(0, -300px, 0);
                    opacity: 1;
               }


               hr {
                    margin: 0px 15px !important;
                    color: <?php echo $hr_color ?>;
               }
          </style>
          <script>
               if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
               }
          </script>
     </head>

     <body>
          <div class="modal no-blur show d-block" id="imageModal" tabindex="-1" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" style="max-width: 960px;">
                    <div class="modal-body image">
                         <div class="modal-content image">
                              <div class="modal-content" style="border-radius: 32px 32px 0px 0px; padding: 0;">
                                   <img src="<?php echo $banner ?>" style="width: 100%; height: 100%; border-radius: 32px 32px 0px 0px;">

                                   <div class="image-text alternative">
                                        <div class="card blurred" style="margin-left: 25px; margin-right: 25px; bottom: -50px; z-index: 1000;">
                                             <div class="row">
                                                  <div class="col-auto">
                                                       <img src="<?php echo $avatar ?>" style="border-radius: 50%; height: 60px; width: 60px; object-fit: cover;">
                                                  </div>
                                                  <div class="col-auto p-0">
                                                       <h1 style="line-height: 1;">
                                                            <?php echo $username; ?>
                                                            <?php if ($admin == "Admin") { ?>
                                                                 <span class="badge bg-secondary" style="border: none !important; font-size: 12px;"><i class="fas fa-user-cog p-0 white-icon"></i> Staff</span>
                                                            <?php } else { ?>
                                                                 <span class="badge bg-secondary" style="border: none !important; font-size: 12px;"><i class="fas fa-user p-0 white-icon"></i> Member</span>
                                                            <?php } ?>
                                                            <!-- <span class="badge bg-secondary" style="border: none !important; font-size: 12px;"><i class="fas fa-user-check p-0 white-icon"></i> Premium</span> -->
                                                       </h1>
                                                       <small style="line-height: 0.5 !important;">
                                                            <?php if ($status == "") { ?>
                                                                 <i style="padding: 0; color: #cccccc;">Hasn't set his status yet.</i>
                                                            <?php } else { ?>
                                                                 <i style="padding: 0; color: #cccccc;"><?php echo $status ?></i>
                                                            <?php } ?>
                                                       </small>
                                                       <br>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="modal-content border-0" style="max-width: 100%;">
                                   <br>
                                   <?php if ($description == "") { ?>
                                        <h1><?php echo $username ?>'s portfolio</h1>
                                        is empty now. <?php echo $username ?> has to set some text.
                                   <?php } else { ?>
                                        <?php echo $description ?>
                                   <?php } ?>
                              </div>
                              <br>
                              <div class="modal-content" style="border-radius: 16px !important; padding: 15px;">
                                   <small>
                                        helist.host
                                        <b>|</b>
                                        Made by <b>Clynt</b> and helist.host community 🖤
                                        <b>|</b>
                                   </small>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </body>

     </html>

<?php } ?>