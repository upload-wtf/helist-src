<?php

include '../src/database.php';
include '../src/config.php';
include '../src/functions.php';

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

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
$avatar = $embed['avatar'];
$id = $embed['id'];
$uuid = $embed['uuid'];
$regdate = $embed['reg_date'];
$uploads = $embed['uploads'];
$banner = $row['bio_background'];
$username = $row['username'];
$status = $row['status'];
$description = $row['description'];
$premium = $row['premium'];
$admin = $row['admin'];
$custom_domain = $row['use_customdomain'];
$email = $row['email'];

$sql = "SELECT secret FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$secret = $row['secret'];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_assoc($result);
$subdomain = $rows['subdomain'];
$selecteddomain = $rows['domain'];
$banner = $rows['bio_background'];

$errors = [];

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
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
                    <li><a href="/dashboard" style="color: white">Home</a></li>
                    <li><a href="/dashboard/settings">Settings</a></li>
                    <li><a href="/dashboard/images">Images</a></li>
                    <li><a href="#modal-invites" uk-toggle>Invites</a></li>
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
    </div><br>
        <div class="uk-container">
            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Uploads</h3>
                        <p>
                            <?php echo $uploads; ?>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">Storage used</h3>
                        <p><?php
                        $totalfillessize = human_filesize(
                            GetDirectorySize("../uploads/$uuid/$username"),
                            2
                        );
                        echo $totalfillessize;
                        ?>
                        </p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-body">
                        <h3 class="uk-card-title">UID</h3>
                        <p>
                            <?php echo $id; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="uk-container uk-margin-medium-top uk-margin-small-bottom">
         <div class="uk-child-width-1-2@s uk-grid-small uk-flex" uk-grid>
            <div>
               <div class="uk-border-rounded uk-card uk-card-default uk-card-small">
                  <div class="uk-card-body">
                     <div class="uk-container uk-container-center">
                        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
                           <div class="uk-width-medium-1-1">
                              <div class="uk-panel uk-text-center">
                                 <h3 class="uk-heading-line uk-text-center"><span>Submit domain</span></h3>
                              </div>
                           </div>
                        </section>
                     </div><br>
                     <form action="" method="POST">
                        <div class="uk-margin">
                           <div class="uk-inline">
                              <span class="uk-form-icon" uk-icon="icon: world"></span>
                              <input class="uk-input" type="text" name="domain" placeholder="Domain">
                           </div>
                        </div>
                        <div class="uk-margin">
                           <button class="uk-button uk-button-primary" type="submit" name="add_domain">Submit</button>
                        </div>
                     </form>
                  </div>
                  <div class="test-upload uk-placeholder uk-text-center">
            <span uk-icon="icon: cloud-upload"></span>
            <form action="https://helist.host/api/upload" enctype="multipart/form-data" id="schneeger" method="POST">
            <span class="uk-text-middle" id="uploadbutton">Attach file by dropping them here or</span>
            <div uk-form-custom>
            <input type="file" multiple>
            <span class="uk-link" id="uploadbutton">selecting one</span>
            </div>
            </div>
<progress id="progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                    </form>
               </div>
            </div>

            <div>
               <div class="uk-border-rounded uk-card uk-card-default uk-card-small">
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
                     $embed = str_replace(
                         '%username',
                         $_SESSION['username'],
                         $embed
                     );
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
                            <img src="https://imgur.com/yLIXHjk.png" class="embed-img" alt="Preview image">
                            <!-- <img src="./App/Assets/img/ambedimg.png" class="embed-img" alt="Preview image"> -->
                        </div>
                     <div>
                  </div>
               </div>
            </div>
        </div>
    </div>
    <div id="modal-invites" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
    <div class="uk-card-body">
        <div>
        <section class="uk-grid uk-grid-match" data-uk-grid-margin="">
            <div class="uk-width-medium-1-1">
                <div class="uk-panel uk-text-center">
                    <h3 class="uk-heading-line uk-text-center"><span>Invites</span></h3>
                </div>
            </div>
        </section>
        </div><br>
        <?php
        $sql = "SELECT * FROM invites WHERE inviteAuthor = '$username'";
        $result = mysqli_query($db, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            echo '<p>You have no invites</p>';
        } else {
            while ($row = mysqli_fetch_assoc($result)) { ?>

<div class="uk-margin">
<div class="uk-inline">
<span onclick="copy_code('https://helist.host/invite/<?php echo $row[
    'inviteCode'
]; ?>')">
<a href="#" class="uk-list-item"><?php echo $row['inviteCode']; ?></a>
</span>
</div>
</div>

                <?php }
        }
        ?>

        </div>
        <div>
    </div>
    </div>
</body>
<script>
(function ($) {
    var bar = $("#progressbar")[0];
    UIkit.upload('.test-upload', {
        url: '',
        multiple: true,
        beforeSend: function() { console.log('beforeSend', arguments); },
        beforeAll: function() { console.log('beforeAll', arguments); },
        load: function() { console.log('load', arguments); },
        error: function() { console.log('error', arguments); },
        complete: function() { console.log('complete', arguments); },
        loadStart: function (e) {
            console.log('loadStart', arguments);
            bar.removeAttribute('hidden');
            bar.max =  e.total;
            bar.value =  e.loaded;
        },
        progress: function (e) {
            console.log('progress', arguments);
            bar.max =  e.total;
            bar.value =  e.loaded;
        },
        loadEnd: function (e) {
            console.log('loadEnd', arguments);
            bar.max =  e.total;
            bar.value =  e.loaded;
        },
        completeAll: function () {
            console.log('completeAll', arguments);
            setTimeout(function () {
                bar.setAttribute('hidden', 'hidden');
            }, 1000);
            toastr.success('Upload complete', 'Success');
        },

        // document ready upload helist.host/api/upload?secret=<?php echo $secret; ?>&use_sharex=true
        $(docuement)

    });
})(jQuery);

</script>
<script>

function copy_code(code) {
    navigator.clipboard.writeText(code);
    toastr.success("Invite copied to the clipboard", "Success")
    $("#copy-invite-p").text("Ivite code copied");
}
$(".discount-box").mouseleave(function() {
    setTimeout(
        function() {
            $("#copy-invite-p").text("Click to copy code");
        }, 150);
});
</script>

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
