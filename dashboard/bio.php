<?php

include '../src/database.php';
include '../src/config.php';
include '../src/functions.php';

if (isset($_GET["user"])) {
  $user = $_GET["user"];
  $sql = "SELECT * FROM users WHERE username = '$user'";
  $avatar = $row['avatar'];
  $username = $row['username'];
  $discord_bio = $row['discord_bio'];
  $email_bio = $row['email_bio'];
  $github_bio = $row['github_bio'];
  $telegram_bio = $row['telegram_bio'];
  $steam_bio = $row['steam_bio'];

  echo '
  <!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="utf-8">


    <title>'. $username .'</title>
  
  <meta name="description" content="Долбоеб">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  <script src="https://kit.fontawesome.com/c4a5e06183.js" crossorigin="anonymous"></script>
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/animate.css">
  

  <link rel="stylesheet" href="../assets/css/share.button.css">
  <link rel="stylesheet" href="../assets/css/brands.css">
  <link rel="stylesheet" href="../assets/css/skeleton-auto.css">
  <link rel="stylesheet" href="../assets/css/animations.css">

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
                    <img alt="avatar" class="rounded-avatar fadein" src="'. $avatar .'" width="128px" height="128px" style="object-fit: cover;">
          
        <h1 class="fadein">'. $username .'</h1>

      ';
      if ($discord_bio != "") {
        echo '<div style="--delay: 1s" class="button-entrance"><a class="button button-discord button button-hover icon-hover" rel="noopener noreferrer nofollow" href="'. $discord_bio .'" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\discord.svg">Discord</a></div>';
      } else if ($email_bio != "") {
        echo '<div style="--delay: 2s" class="button-entrance"><a class="button button-default email button button-hover icon-hover" rel="noopener noreferrer nofollow" href="'. $email_bio .'" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\email.svg">Email</a></div>';
      } else if ($github_bio != "") {
        echo '<div style="--delay: 3s" class="button-entrance"><a class="button button-github button button-hover icon-hover" rel="noopener noreferrer nofollow" href="'. $github_bio .'" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\github.svg">Github</a></div>';
      } else if ($telegram_bio != "") {
        echo '<div style="--delay: 4s" class="button-entrance"><a class="button button-telegram button button-hover icon-hover" rel="noopener noreferrer nofollow" href="'. $telegram_bio .'" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\telegram.svg">Telegram</a></div>';
      } else if ($steam_bio != "") {
        echo '<div style="--delay: 5s" class="button-entrance"><a class="button button-steam button button-hover icon-hover" rel="noopener noreferrer nofollow" href="'. $steam_bio .'" target="_blank"><img alt="button-icon" class="icon hvr-icon" src="https://sber-chan.me/\/littlelink/icons\steam.svg">Steam</a></div>';
      } else {

      }
        echo '
        <div class="container">
	</section>
</a></div><br>
</div>          
      </div>
    </div>
  </div>
</body>
</html>';
} else {

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: /');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['banned'] == 'true') {
    header('location: /logout');
}

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Bio</title>
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
                  <li><a href="/dashboard" >Home</a></li>
                  <li><a href="/dashboard/settings">Settings</a></li>
                  <li><a href="/dashboard/bio" style="color: white">Bio</a></li>
                  <li><a href="/dashboard/images">Images</a></li>
                  <li><a href="/dashboard/mail">Mail</a></li>
                  <?php if ($admin == '1') { ?>
                    <li><a href="/dashboard/admin">Admin</a></li>
                    <?php } ?>
                  <li><a href="/dashboard/logout">Logout</a></li>
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
      </div>
      <br>
      <div class="uk-container uk-margin-medium-top uk-margin-small-bottom">
         <h2 class="uk-margin-medium-bottom">Bio Page</h2>
         <div class="uk-child-width-1-2@s uk-grid-small uk-flex" uk-grid>
            <div>
               <div class="uk-border-rounded uk-card uk-card-default uk-card-small">
                  <div class="uk-card-body">
                     <div class="uk-container uk-container-center">
                        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                           <div class="uk-width-medium-1-1">
                              <div class="uk-panel uk-text-center">
                                 <h3 class="uk-heading-line uk-text-center"><span>Page</span></h3>
                              </div>
                           </div>
                        </section>
                     </div><br>
                     <form action="" method="post" name="form">
                    <center>
                      <div class="uk-margin">
                        <div class="uk-inline">
                          <span class="uk-form-icon" uk-icon="icon: user"></span>
                          <input class="uk-input" type="text" name="discord_bio" placeholder="Discord" value="<?php echo $row['discord_bio']; ?>">
                        </div>
                      </div>
                      <div class="uk-margin">
                        <div class="uk-inline">
                          <span class="uk-form-icon" uk-icon="icon: mail"></span>
                          <input class="uk-input" type="text" name="email_bio" placeholder="Email" value="<?php echo $row['email_bio']; ?>">
                        </div>
                      </div>
                      <div class="uk-margin">
                        <div class="uk-inline">
                          <span class="uk-form-icon" uk-icon="icon: github"></span>
                          <input class="uk-input" type="text" name="github_bio" placeholder="Github" value="<?php echo $row['github_bio']; ?>">
                        </div>
                      </div>
                      <div class="uk-margin">
                        <div class="uk-inline">
                          <span class="uk-form-icon" uk-icon="icon: telegram"></span>
                          <input class="uk-input" type="text" name="telegram_bio" placeholder="Telegram" value="<?php echo $row['telegram_bio']; ?>">
                        </div>
                      </div>
                      <div class="uk-margin">
                        <div class="uk-inline">
                          <span class="uk-form-icon" uk-icon="icon: steam"></span>
                          <input class="uk-input" type="text" name="steam_bio" placeholder="Steam" value="<?php echo $row['steam_bio']; ?>">
                        </div>
                      </div>
                        <br>
                        <div class="uk-form-row">
                           <button class="uk-button uk-button-primary" type="submit" name="update-bio">Update Bio Page</button>
                        </div>
                     </center>
                     </form>
                  </div>
                  <div class="uk-card-body">
                  </div>
               </div>
            </div>
            <div>
               <div class="uk-border-rounded uk-card uk-card-default uk-card-small">
                  <div class="uk-card-body">
                     <div>
                        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                           <div class="uk-width-medium-1-1">
                              <div class="uk-panel uk-text-center">
                                 <h3 class="uk-heading-line uk-text-center"><span>Preview</span></h3>
                              </div>
                           </div>
                        </section>
                     </div>
                     <center>Soon</center>
                     <div>
                     <br>
                     </div> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="modal-preview" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
    <div class="uk-card-body">
        <div>
        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-text-center">
                    <h3 class="uk-heading-line uk-text-center"><span>Embed preview</span></h3>
                </div>
            </div>
        </section>
        </div><br>

        <?php
        $date = date('Y-m-d');
        $embed = str_replace('%username', $_SESSION['username'], $embed);
        $embed = str_replace('%filename', 'preview.png', $embed);
        $embed = str_replace('%filesize', '1.0MB', $embed);
        $embed = str_replace('%id', $id, $embed);
        $embed = str_replace('%discordtag', $row['discord_username'], $embed);
        $embed = str_replace('%date', $date, $embed);
        $embed = str_replace('%uploads', $uploads, $embed);
        ?>
        <div class="embed-body" id="e-color" style="border-left: 5px solid <?php echo $embed[
            'embedcolor'
        ]; ?>;">
            <span class="embed-author" id="e-author"><?php echo $embed[
                'embedauthor'
            ]; ?></span>
            <span class="embed-title" id="e-title"><?php echo $embed[
                'embedtitle'
            ]; ?></span>
            <span class="embed-desc" id="e-description"><?php echo $row[
                'embeddesc'
            ]; ?></span>
            <!-- <img src="https://imgur.com/yLIXHjk.png" class="embed-img" alt="Preview image"> -->
            <img src="https://helist.host/assets/img/helist-logo.png" class="embed-img" alt="Preview image">
        </div>
        <div>
    </div>
    </div>

    <div id="modal-webhook" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
    <div class="uk-card-body">
        <div>
        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-text-center">
                    <h3 class="uk-heading-line uk-text-center"><span>Webhook logs</span></h3>
                </div>
            </div>
        </section>
        </div><br>
        <form action="" method="POST">
        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: link"></span>
                <input class="uk-input" type="text" name="webhook" value="<?php echo $webhook ?>" placeholder="Discord Webhook">
            </div>
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-primary" type="submit" name="set_webhook">Submit</button>
        </div>
        </form>
        <div>
    </div>
    </div>

    <div id="modal-custom-path" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
    <div class="uk-card-body">
        <div>
        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-text-center">
                    <h3 class="uk-heading-line uk-text-center"><span>Update Custom Path</span></h3>
                </div>
            </div>
        </section>
        </div><br>
        <form action="" method="POST">
        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: folder"></span>
                <input class="uk-input" type="text" name="path" value="<?php echo $userpath ?>" placeholder="Path">
            </div>
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-primary" type="submit" name="set_custom_path">Update</button>
        </div>
        </form>
        <div>
    </div>
    </div>

</div>

   </body>
<script>
   $(document).on('keyup', '#tooltip', function() {
        if ($(this).val().length > 0) {
            $('#tooltip-dropdown').show();
        } else {
            $('#tooltip-dropdown').hide();
        }
    });
    </script>
   <?php

if(isset($_POST['set_custom_path'])){
    $path = $_POST['path'];
    $sql = "UPDATE users SET path = '$path' WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    if($result){
        echo '<script>toastr.success("Succsessfully added path.", "Success")</script>';
        echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
    } else {
        echo '<script>toastr.error("Something went wrong.", "Error")</script>';
        echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
    }
}

   if (isset($_POST['unlink'])) {
       $sql = "UPDATE users SET discord_username = 'user#0000', discord_id = NULL WHERE username = '$username'";
       $result = mysqli_query($db, $sql);
       if ($result) {
           echo '<script>toastr.success("Succsessfully unlinked discord", "Success")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       } else {
           echo '<script>toastr.error("Failed to unlink discord", "Error")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       }

       echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
   }

   if (isset($_POST['config'])) {
       echo "
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>helist.host</title>
    </head>
    <script>
    var fileContent = '{\"Version\": \"1.0.0\",\"Name\": \"helist.host $username\",\"DestinationType\": \"ImageUploader, FileUploader\",\"RequestMethod\": \"POST\",\"RequestURL\": \"https://helist.host/upload\",\"Parameters\": {\"secret\": \"$secret\",\"use_sharex\": \"true\"},\"Body\": \"MultipartFormData\",\"FileFormName\": \"file\"}';
    var fileName = 'config.sxcu';
    
    const blob = new Blob([fileContent], { type: 'text/plain' });
    const a = document.createElement('a');
    a.setAttribute('download', fileName);
    a.setAttribute('href', window.URL.createObjectURL(blob));
    a.click();
    </script>";
   } else {
   }

   if(isset($_POST['set_webhook'])) {
    $webhook = $_POST['webhook'];
    $sql = "UPDATE users SET webhook='$webhook' WHERE username='$username'";
    $result = mysqli_query($db, $sql);
    if($result) {
        echo '<script>toastr.success("Succsessfully added webhook. Remove webhook to disable!", "Success")</script>';
        echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
    } else {
        echo '<script>toastr.error("Failed to update webhook", "Error")</script>';
        echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
    }
    echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";

}

   if (isset($_POST['getNewKey'])) {
       $newSecret = generateRandomInt(16);
       $sql =
           "UPDATE `users` SET `secret` = '$newSecret' WHERE `username` = '" .
           $_SESSION['username'] .
           "'";
       $result = mysqli_query($db, $sql);
       if ($result) {
           echo '<script>toastr.success("Succsessfully generated new secret", "Success")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       } else {
           echo '<script>toastr.error("Failed to generate new secret", "Error")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       }

       echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
   }

   if (isset($_POST['update-domain'])) {
       $domain = $_POST['selecteddomain'];
       $subdomain = $_POST['subdomain'];

       $sql =
           "UPDATE users SET subdomain='" .
           $_POST['subdomain'] .
           "' WHERE username='" .
           $username .
           "';";
       $result = mysqli_query($db, $sql);
       $sql =
           "UPDATE users SET domain='" .
           $_POST['selecteddomain'] .
           "' WHERE username='" .
           $username .
           "';";
       $result = mysqli_query($db, $sql);

       // check if $subdomain is empty
       if (empty($subdomain)) {
           $sql =
               "UPDATE users SET upload_domain='" .
               $_POST['selecteddomain'] .
               "' WHERE username='" .
               $username .
               "';";
           $result = mysqli_query($db, $sql);
       } else {
           $sql =
               "UPDATE users SET upload_domain='" .
               $_POST['subdomain'] .
               '.' .
               $_POST['selecteddomain'] .
               "' WHERE username='" .
               $username .
               "';";
           $result = mysqli_query($db, $sql);
       }

       if ($result) {
           echo '<script>toastr.success("Succsessfully updated domain", "Success")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       } else {
           echo '<script>toastr.error("Failed to update domain", "Error")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       }

       echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
   }

   if (isset($_POST['update-embed'])) {
       if (
           isset($_POST['embedauthor']) &&
           isset($_POST['embedtitle']) &&
           isset($_POST['embeddesc']) &&
           isset($_POST['colorpicker'])
       ) {
           $sql2 =
               "UPDATE users SET embedauthor='" .
               $_POST['embedauthor'] .
               "', embedtitle='" .
               $_POST['embedtitle'] .
               "', embeddesc='" .
               $_POST['embeddesc'] .
               "', embedcolor='" .
               $_POST['colorpicker'] .
               "' WHERE username='" .
               $username .
               "';";
           $result2 = mysqli_query($db, $sql2);
       }
       if ($result2) {
           echo '<script>toastr.success("Succsessfully updated embed", "Success")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       } else {
           echo '<script>toastr.error("Failed to update embed", "Error")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       }
       echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
   }

   if (isset($_GET['update-settings'])) {
       if (isset($_POST['use_customdomain'])) {
           $sql3 =
               "UPDATE users SET use_customdomain='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (!isset($_POST['use_customdomain'])) {
           $sql3 =
               "UPDATE users SET use_customdomain='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (isset($_POST['use_custom_path'])) {
        $sql3 =
            "UPDATE users SET use_custom_path='true' WHERE username='" .
            $username .
            "';";
        $result3 = mysqli_query($db, $sql3);
    }

    if (!isset($_POST['use_custom_path'])) {
        $sql3 =
            "UPDATE users SET use_custom_path='false' WHERE username='" .
            $username .
            "';";
        $result3 = mysqli_query($db, $sql3);
    }

       if (isset($_POST['anonym_upload'])) {
        $sql3 =
            "UPDATE users SET anonym_page='true' WHERE username='" .
            $username .
            "';";
        $result3 = mysqli_query($db, $sql3);
    }

    if (!isset($_POST['anonym_upload'])) {
        $sql3 =
            "UPDATE users SET anonym_page='false' WHERE username='" .
            $username .
            "';";
        $result3 = mysqli_query($db, $sql3);
    }

       if (isset($_POST['filename_type'])) {
           $sql3 =
               "UPDATE users SET filename_type='long' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (isset($_POST['filename_type'])) {
           $sql3 =
               "UPDATE users SET filename_type='long' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['filename_type'])) {
           $sql3 =
               "UPDATE users SET filename_type='short' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['filename_type'])) {
           $sql3 =
               "UPDATE users SET filename_type='short' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (isset($_POST['use_invisible_url'])) {
           $sql3 =
               "UPDATE users SET use_invisible_url='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (isset($_POST['use_invisible_url'])) {
           $sql3 =
               "UPDATE users SET use_invisible_url='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['use_invisible_url'])) {
           $sql3 =
               "UPDATE users SET use_invisible_url='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['use_invisible_url'])) {
           $sql3 =
               "UPDATE users SET use_invisible_url='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (isset($_POST['self_destruct_upload'])) {
           $sql3 =
               "UPDATE users SET self_destruct_upload='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (isset($_POST['self_destruct_upload'])) {
           $sql3 =
               "UPDATE users SET self_destruct_upload='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['self_destruct_upload'])) {
           $sql3 =
               "UPDATE users SET self_destruct_upload='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['self_destruct_upload'])) {
           $sql3 =
               "UPDATE users SET self_destruct_upload='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (isset($_POST['use_sus_url'])) {
           $sql3 =
               "UPDATE users SET use_sus_url='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (isset($_POST['use_sus_url'])) {
           $sql3 =
               "UPDATE users SET use_sus_url='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['use_sus_url'])) {
           $sql3 =
               "UPDATE users SET use_sus_url='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['use_sus_url'])) {
           $sql3 =
               "UPDATE users SET use_sus_url='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (isset($_POST['url_type'])) {
           $sql3 =
               "UPDATE users SET url_type='long' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (isset($_POST['url_type'])) {
           $sql3 =
               "UPDATE users SET url_type='long' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['url_type'])) {
           $sql3 =
               "UPDATE users SET url_type='short' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['url_type'])) {
           $sql3 =
               "UPDATE users SET url_type='short' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if (isset($_POST['use_emoji_url'])) {
           $sql3 =
               "UPDATE users SET use_emoji_url='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (isset($_POST['use_emoji_url'])) {
           $sql3 =
               "UPDATE users SET use_emoji_url='true' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['use_emoji_url'])) {
           $sql3 =
               "UPDATE users SET use_emoji_url='false' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }
       if (!isset($_POST['use_emoji_url'])) {
           $sql3 =
               "UPDATE users SET use_emoji_url='short' WHERE username='" .
               $username .
               "';";
           $result3 = mysqli_query($db, $sql3);
       }

       if ($result3) {
           echo '<script>toastr.success("Succsessfully updated preferences", "Success")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       } else {
           echo '<script>toastr.error("Error updating preferences", "Error")</script>';
           echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
       }

       echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/settings'>";
   }
   ?>


   <script>
      function get(form) {
           if (form.confirm.checked) {
      
           } else {
      
           }
      }

      function repl(s) 
      {
        return s.replace(/{file}/g, 'asyl-is-gay.png').replace(/{username}/g, "<?php echo $username; ?>").replace(/{uid}/g, "<?php echo $id; ?>").replace(/{filename}/g, '1337').replace(/{size}/g, '13.37 KB').replace(/{ext}/g, 'png').replace(/{date}/g, '<?php echo date('m/d/Y'); ?>')
    }

    function updateAuthor(value) {
        document.getElementById("e-author").innerHTML = repl(value);
    }

    function updateTitle(value) {
        document.getElementById('e-title').innerHTML = repl(value);
    }

    function updateDescription(value) {
        document.getElementById("e-description").innerHTML = repl(value);
    }

    function updateColor(value) {
        document.getElementById("e-color").style.borderLeft = "5px solid " + value;
    }

    updateAuthor(document.getElementById('e-author').innerHTML);
    updateTitle(document.getElementById('e-title').innerHTML);
    updateDescription(document.getElementById('e-description').innerHTML);
    updateColor(document.getElementById('e-color').innerHTML);
   </script>

<script>
     function download(filename, text) {
          var element = document.createElement('a');
          element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
          element.setAttribute('download', filename);

          element.style.display = 'none';
          document.body.appendChild(element);

          element.click();

          document.body.removeChild(element);
     }

     function generateConfig() {
          var text = ``;

          var filename = "helist.host-<?php echo $_SESSION[
              'username'
          ]; ?>.sxcu";
          setTimeout(() => {
               download(filename, text);
          }, 1000)
     }




</script>
</html>

<?php 
} ?>
