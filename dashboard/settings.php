<?php

require_once '../src/config.php';
require_once '../src/database.php';
require_once '../src/functions.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: ../');
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
if ($embed['use_customdomain'] == 'true') {
    $usecustomdomain = 'checked';
} else {
    $usecustomdomain = 'false';
}

if ($embed['use_invisible_url'] == 'true') {
    $invisible_url = 'checked';
} else {
    $invisible_url = 'false';
}
if ($embed['filename_type'] == 'long') {
    $uselongfilename = 'checked';
} else {
    $uselongfilename = 'false';
}

if ($embed['url_type'] == 'long') {
    $uselongurl = 'checked';
} else {
    $uselongurl = 'false';
}
if ($embed['self_destruct_upload'] == 'true') {
    $self_destruct_upload = 'checked';
} else {
    $self_destruct_upload = 'false';
}

if($embed['anonym_page'] == 'true') {
    $anonym_page = 'checked';
} else {
    $anonym_page = 'false';
}

if ($embed['use_emoji_url'] == 'true') {
    $emoji_url = 'checked';
} else {
    $emoji_url = 'false';
}

if ($embed['use_sus_url'] == 'true') {
    $use_sus_url = 'checked';
} else {
    $use_sus_url = 'false';
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['banned'] == 'true') {
    header('location: /logout');
}

if ($row['use_embed'] == 'true') {
    $useembed = 'checked';
} else {
    $useembed = 'false';
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
$avatar = $embed['avatar'];
$secret = $embed['secret'];
$id = $embed['id'];
$regdate = $embed['reg_date'];
$uploads = $embed['uploads'];
$banner = $row['bio_background'];
$username = $row['username'];
$status = $row['status'];
$description = $row['description'];
$premium = $row['premium'];
$admin = $row['admin'];
$custom_domain = $row['use_customdomain'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_assoc($result);
$subdomain = $rows['subdomain'];
$selecteddomain = $rows['domain'];
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Settings</title>
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
                  <li><a href="/dashboard/settings" style="color: white">Settings</a></li>
                  <li><a href="/dashboard/images">Images</a></li>
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
         <h2 class="uk-margin-medium-bottom">Settings</h2>
         <div class="uk-child-width-1-2@s uk-grid-small uk-flex" uk-grid>
            <div>
               <div class="uk-border-rounded uk-card uk-card-default uk-card-small">
                  <div class="uk-card-body">
                     <div class="uk-container uk-container-center">
                        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                           <div class="uk-width-medium-1-1">
                              <div class="uk-panel uk-text-center">
                                 <h3 class="uk-heading-line uk-text-center"><span>Embed</span></h3>
                              </div>
                           </div>
                        </section>
                     </div>
                     <center>Variables: %username, %filename, %filesize, %id, %date, %uploads</center>
                     <form action="" method="post" name="form">
                        <div class="uk-form-row">
                           <label class="uk-form-label" for="embedauthor">Embed Author</label>
                           <input class="uk-input" type="text" name="embedauthor" id="embedauthor" value="<?php echo $embed[
                               'embedauthor'
                           ]; ?>" onkeyup="updateAuthor(this.value)" onkeydown="updateAuthor(this.value)" onchange="updateAuthor(this.value)" onpaste="updateAuthor(this.value)" oninput="updateAuthor(this.value)"/>
                        </div>
                        <div class="uk-form-row">
                           <label class="uk-form-label" for="embedtitle">Embed Title</label>
                           <input class="uk-input" type="text" name="embedtitle" id="embedtitle" value="<?php echo $embed[
                               'embedtitle'
                           ]; ?>" onkeyup="updateTitle(this.value)" onkeydown="updateTitle(this.value)" onchange="updateTitle(this.value)" onpaste="updateTitle(this.value)" oninput="updateTitle(this.value)"/>
                        </div>
                        <div class="uk-form-row">
                           <label class="uk-form-label" for="titleurl">Embed Title URL</label>
                           <input class="uk-input" type="text" name="titleurl" id="titleurl" value="<?php echo $embed[
                               'embedurl'
                           ]; ?>" />
                           </div>
                        <div class="uk-form-row">
                           <label class="uk-form-label" for="embeddesc">Embed Description</label>
                           <input class="uk-input" type="text" name="embeddesc" id="embeddescription" value="<?php echo $row[
                               'embeddesc'
                           ]; ?>" onkeyup="updateDescription(this.value)" onkeydown="updateDescription(this.value)" onchange="updateDescription(this.value)" onpaste="updateDescription(this.value)" oninput="updateDescription(this.value)" />
                        </div>
                        <div class="uk-form-row">
                           <label class="uk-form-label" for="colorpicker">Embed Color</label>
                           <input class="uk-input" type="color" id="colorpicker" name="colorpicker" value="<?php echo $embed[
                               'embedcolor'
                           ]; ?>" oninput="updateColor(this.value)"/>
                        </div>
                        <br>
                        <div class="uk-form-row">
                           <button class="uk-button uk-button-primary" type="submit" name="update-embed">Update Embed</button>
                           <button class="uk-button uk-button-primary" type="button" uk-toggle="target: #modal-preview">Preview</button>
                           <button class="uk-button uk-button-primary" type="button" uk-toggle="target: #modal-webhook">Webhook logs</button>
                        </div>
                     </form>
                  </div>
                  <div class="uk-container uk-container-center">
                     <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-1">
                           <div class="uk-panel uk-text-center">
                              <h3 class="uk-heading-line uk-text-center"><span>Preferences</span></h3>
                           </div>
                        </div>
                     </section>
                  </div>
                  <div class="uk-card-body">
                     <form action="?update-settings" method="post" name="form" enctype="multipart/form-data">
                        <!-- CUSTOM DOMAIN -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" <?php echo $usecustomdomain; ?> name="use_customdomain">
                           <label class="custom-control-label" for="customCheck1">Custom Domain</label>
                        </div>
                        <!-- INVISIBLE URL -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="use_invisible_url" <?php echo $invisible_url; ?>>
                           <label class="custom-control-label" for="customCheck2">Invisible URL</label>
                        </div>
                        <!-- EMOJI URL -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="use_emoji_url" <?php echo $emoji_url; ?>>
                           <label class="custom-control-label" for="customCheck3">Emoji URL</label>
                        </div>
                        <!-- LONG FILENAME -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="filename_type" <?php echo $uselongfilename; ?>>
                           <label class="custom-control-label" for="customCheck3">Long filename</label>
                        </div>
                        <!-- RAW URL -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="url_type" <?php echo $uselongurl; ?>>
                           <label class="custom-control-label" for="customCheck3">Raw URL</label>
                        </div>
                        <!-- AMONGUS URL -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="use_sus_url" <?php echo $use_sus_url; ?>>
                           <label class="custom-control-label" for="customCheck3">AmongUs URL</label>
                        </div>
                        <!-- SELF DESTRUCT UPLOAD -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="self_destruct_upload" <?php echo $self_destruct_upload; ?>>
                           <label class="custom-control-label" for="customCheck3">Self destruct upload</label>
                        </div>
                        <!-- ANONYM UPLOAD PAGE -->
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" class="custom-control-input" name="anonym_upload" <?php echo $anonym_page; ?>>
                           <label class="custom-control-label" for="customCheck3">Anonym upload</label>
                        </div>
                        <button type="submit" class="uk-button uk-button-primary" name="button1" onclick="abfrage(this.form)" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Save
                        </button>
                     </form>
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
                                 <h3 class="uk-heading-line uk-text-center"><span>User</span></h3>
                              </div>
                           </div>
                        </section>
                     </div>
                     <form method="POST" class="uk-text-center">
                        <div class="uk-container uk-container-center">
                           <div class="uk-text-large">
                              <p>Username: <?php echo $_SESSION[
                                  'username'
                              ]; ?></p>
                              <p>UID: <?php echo $embed['id']; ?></p>
                              <p>Total upload: <?php echo $uploads; ?></p>
                              <p>Upload Key: <br><b class="blur"><?php echo $row[
                                  'secret'
                              ]; ?></b>
                                 <?php if ($row['discord_username'] != '') { ?>
                              <p>Discord: <br><b><?php echo $row[
                                  'discord_username'
                              ]; ?></b>
                                 <?php } ?>
                           </div>
                           <button class="uk-button uk-button-default uk-button-small" name="config" id="config" type="submit"><span uk-icon="download"></span>Config</button>
                           <button class="uk-button uk-button-default uk-button-small" name="getNewKey" id="getNewKey" type="submit"><span uk-icon="refresh"></span>regenerate key</button>
                           <?php if ($row['discord_username'] == '') { ?>
                           <a href="https://discord.com/api/oauth2/authorize?client_id=886563642127052860&redirect_uri=https%3A%2F%2Fhelist.host%2Fdiscord&response_type=code&scope=identify%20guilds.join%20email" class="uk-button uk-button-default uk-button-small"><span uk-icon="discord"></span>Link Discord</a>
                           <?php } ?>
                           <?php if ($row['discord_username'] != '') { ?>
                           <button type="submit" name="unlink" id="unlink" class="uk-button uk-button-default uk-button-small" uk-tooltip="This will remove your Role and Nickname from our Discord Server."><span uk-icon="discord"></span>Unlink Discord</button>
                           <?php } ?>
                     </form>
                     <div>
                     <br>
                     <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                     <div class="uk-width-medium-1-1">
                     <div class="uk-panel uk-text-center">
                     <h3 class="uk-heading-line uk-text-center"><span>Domain</span></h3>
                     </div>
                     </div>
                     </section>
                     </div> 
                     <form method="post">
                     <div class="input-group mb-3">
                     <input type="text" name="subdomain" class="uk-input" <?php if (
                         empty($subdomain)
                     ) {
                         echo 'placeholder="subdomain"';
                     } else {
                         echo 'value="' . $subdomain . '"';
                     } ?>/>
                     </div>
                     <div class="input-group mb-3">
                     <select class="uk-select" name="selecteddomain" style="margin-top: 5px;">
                     <option value="<?php echo $selecteddomain; ?>" selected><?php echo $selecteddomain; ?></option>
                     <?php
                     $sql = 'SELECT name FROM domains';
                     $result = mysqli_query($db, $sql);
                     while ($row = mysqli_fetch_assoc($result)) {
                         echo "<option class='bg-dark'>" .
                             $row['name'] .
                             '</option>';
                     }
                     ?>
                     </select>
                     </div><br>
                     <button type="submit" class="uk-button uk-button-primary" name="update-domain" style="width: 100%;"><i class="fas fa-edit white-icon p-0"></i> Change
                     </button>
                     </form>
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
                <input class="uk-input" type="text" name="webhook" placeholder="Discord Webhook">
            </div>
        </div>
        <div class="uk-margin">
            <button class="uk-button uk-button-primary" type="submit" name="set_webhook">Submit</button>
        </div>
        </form>
        <div>
    </div>
    </div>
</div>
   </body>

   <?php
   if (isset($_POST['unlink'])) {
       $sql = "UPDATE users SET discord_username = NULL, discord_id = NULL WHERE username = '$username'";
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
           isset($_POST['titleurl']) &&
           isset($_POST['colorpicker'])
       ) {
           $sql2 =
               "UPDATE users SET embedauthor='" .
               $_POST['embedauthor'] .
               "', embedtitle='" .
               $_POST['embedtitle'] .
               "', embeddesc='" .
               $_POST['embeddesc'] .
               "', embedurl='" .
               $_POST['titleurl'] .
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
        return s.replace(/{file}/g, 'asyl-is-gay.png').replace(/{username}/g, "<?php echo $username; ?>").replace(/{uid}/g, "<?php echo $id; ?>").replace(/{filename}/g, '1337').replace(/{size}/g, '13.37 KB').replace(/{ext}/g, 'png').replace(/{date}/g, '<?php echo date(
    'm/d/Y'
); ?>')
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
          var text = `{
  "Version": "1.1.0",
  "Name": "helist.host - <?php echo $_SESSION['username']; ?>",
  "DestinationType": "ImageUploader, FileUploader",
  "RequestMethod": "POST",
  "RequestURL": "https://helist.host/api/upload",
  "Parameters": {
    "secret": "<?php echo $secret; ?>",
    "use_sharex": "true"
  },
  "Body": "MultipartFormData",
  "FileFormName": "file"
}`;

          var filename = "helist.host-<?php echo $_SESSION[
              'username'
          ]; ?>.sxcu";
          setTimeout(() => {
               download(filename, text);
          }, 1000)
     }
</script>
</html>