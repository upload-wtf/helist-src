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
$webhook = $rows['webhook'];

$randomint = rand(1, 1000000);

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Email</title>
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
                  <li><a href="/dashboard/images">Images</a></li>
                  <li><a href="/dashboard/mail" style="color: white">Mail</a></li>
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
         <h2 class="uk-margin-medium-bottom">E-Mail</h2>
         <div class="uk-child-width-1-2@s uk-grid-small uk-flex" uk-grid>
            <div>
               <div class="uk-border-rounded uk-card uk-card-default uk-card-small">
                  <div class="uk-card-body">
                     <div class="uk-container uk-container-center">
                        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                           <div class="uk-width-medium-1-1">
                              <div class="uk-panel uk-text-center">
                                 <h3 class="uk-heading-line uk-text-center"><span>Email managment</span></h3>
                              </div>
                           </div>
                        </section>
                     </div>

                     <form action="" method="post" name="form"><br><br>
                         <center>
                         <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input class="uk-input" type="text" name="mail" placeholder="Email">
                                
                            </div>
                         </div>

                         <div class="uk-inline">
                         <select class="uk-select" name="selectedmail" style="margin-top: 5px;">
                           <option value="" selected id="schneger">Select Domain</option>
                           <?php
                           $sql = 'SELECT name FROM domains WHERE mail = "true"';
                           $result = mysqli_query($db, $sql);
                           while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option class='bg-dark'>" .
                                 $row['name'] .
                                 '</option>';
                           }
                           ?>
                          </select>
                           </div>

                         <div class="uk-margin">
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input class="uk-input" type="password" name="mail-password" placeholder="Password">
                            </div>
                         </div>
                         <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" name="create-mail">Submit</button>
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
                                 <h3 class="uk-heading-line uk-text-center"><span>Mailboxes</span></h3>
                              </div>
                           </div>
                        </section><br>
                        <center>
                        
                        <?php 
                        
                        $sql = "SELECT * FROM mailboxes WHERE username = '$username'";
                        $result = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $mail = $row['mail']; ?>

                         <div class="uk-margin">
                              <div class="uk-inline">
                                   <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                   <input class="uk-input" type="text" name="mail" value="<?php echo $mail ?>" disabled>
                              </div>
                              <div class="uk-inline">
                                 <form method="POST" action="">
                                   <button class="uk-button uk-button-danger" type="submit" name="delete-mail" value="<?php echo $mail ?>">Delete</button>
                                 </form>
                                   <a href="https://post.novadev.ru/SOGo/"><button class="uk-button uk-button-success">Login</button></a>
                              </div>
                         </div>
                           <?php } ?>
                    </center>
                     </div>
                     <div>
                     <br>
                     </div> 
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>

   </body>

   <script>

       var schneger = document.getElementById('schneger');
       if (schneger.value == "") {
           schneger.value = "helist.email";

       }

   </script>

   <?php

if(isset($_POST["delete-mail"])){

   $mail = $_POST["delete-mail"];
   $sql = "DELETE FROM mailboxes WHERE mail = '$mail'";

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, "https://post.novadev.ru/api/v1/delete/mailbox");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_HEADER, FALSE);

   curl_setopt($ch, CURLOPT_POST, TRUE);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "[
      \"$mail\"
   ]");

   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   "Content-Type: application/json",
   "X-API-Key: 91E0C1-9EC060-274D39-1DBA73-638DA9"
   ));

   $response = curl_exec($ch);
   curl_close($ch);

   // var_dump($response);

   $resp = json_decode($response, true); 
   $type = $resp['type'];

   $sql = "DELETE FROM mailboxes WHERE mail = '$mail'";
   $result = mysqli_query($db, $sql);
   if ($result) {
      echo '<script>toastr.success("Mailbox deleted successfully")</script>';
      echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/mail'>";
   }  else {
      echo '<script>toastr.error("Error deleting mailbox")</script>';
      echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/mail'>";
   }

}


if(isset($_POST["create-mail"])) {

   $mail = $_POST['mail'];
   $mailend = $_POST['selectedmail'];
   $password = $_POST['mail-password'];

   $custommail = $mail . '@' . $mailend;

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, "https://post.novadev.ru/api/v1/add/mailbox");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_HEADER, FALSE);

   curl_setopt($ch, CURLOPT_POST, TRUE);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "{
      \"local_part\": \"$mail\",
      \"domain\": \"$mailend\", 
      \"name\": \"$username\", 
      \"quota\": \"512\", 
      \"password\": \"$password\", 
      \"password2\": \"$password\", 
      \"active\": \"1\" ,
      \"force_pw_update\": \"0\",
      \"tls_enforce_in\": \"0\",
      \"tls_enforce_out\": \"0\"
   }");

   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
   "Content-Type: application/json",
   "X-API-Key: 91E0C1-9EC060-274D39-1DBA73-638DA9"
   ));

   $response = curl_exec($ch);
   curl_close($ch);

   // var_dump($response);

   $resp = json_decode($response, true); 
   $type = $resp['type'];

   // if($type == 'success') {

   $sql = "INSERT INTO mailboxes (id, username, mail) VALUES (NULL, '$username', '$custommail')";
   $result = mysqli_query($db, $sql);
   if ($result) {
      echo '<script>toastr.success("Mailbox created successfully")</script>';
      echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/mail'>";
   } else {
      echo '<script>toastr.error("Error creating mailbox")</script>';
      echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/mail'>";
   }
   // } else {
   //    echo '<script>toastr.error("Error creating mailbox")</script>';
   //    echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/mail'>";
   // }

   }

?>


</html>