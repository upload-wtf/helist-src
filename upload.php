<?php

include "./src/database.php";
include "./src/config.php";
include "./src/functions.php";

$protocol = "https";
try {
    $type = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
    if ($type != "png" && $type != "jpg" && $type != "jpeg" && $type != "gif") {
        echo "Error: only .png .jpg .jpeg .gif files are allowed.";
        exit;
    }
} catch (Exception $e) {
    echo $e;
}
$ip = $_SERVER['REMOTE_ADDR'];
// if (isset($_POST["use_sharex"])) {
//     if ($_POST["use_sharex"] == "true") {
//         $secret = $_POST['secret'];
//     } else {
//         $secret = $_GET['secret'];
//     }
// } else if (isset($_GET["use_sharex"])) {
//     $secret = $_GET['secret'];
// } else {
//     $secret = $_POST['secret'];
// }

$secret = "";
if(!isset($_POST["secret"])){
    $secret = $_SERVER['PHP_AUTH_PW'];
}else{
    $secret = $_POST["secret"];
}

$sql = "SELECT * FROM users WHERE `secret`='" . $secret . "'";
$result = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($result);
$userid = $user['id'];
$username = $user['username'];
$emcolor = $user['embedcolor'];
$emdesc = $user['embeddesc'];
$emauthor = $user['embedauthor'];
$emtitle = $user['embedtitle'];
$use_embed = $user['use_embed'];
$use_customdomain = $user['use_customdomain'];
$invisible_url = $user['use_invisible_url'];
$emoji_url = $user['use_emoji_url'];
$sus_url = $user['use_sus_url'];
$uuid = $user['uuid'];
$custom_path = $user['use_custom_path'];
$path = $user['path'];
$uploadToDomain = $user['upload_domain'];
$uploads = intval($user['uploads']) + 1;
$filename_type = $user['filename_type'];
$url_type = $user['url_type'];
$webhook = $user['webhook'];
$last_uploaded = $user['last_uploaded'];
$banned = $user['banned'];
$domain_schuffle = $user['domain_schuffle'];
$schuffle_domains = $user['schuffle_domains'];
$upload_limit = $user['upload_limit'];
$upload_size_limit = $user['upload_size_limit'];
$self_destruct_upload = $user["self_destruct_upload"];
$use_spoofed_domain = $user["use_spoofed_domain"];
$spoofed_domain = $user["spoofed_domain"];
$sql1121 = "SELECT * FROM toggles";
$result1 = mysqli_query($db, $sql1121);
$user1 = mysqli_fetch_assoc($result1);
$maintenance = $user1['maintenance'];
$allow_uploads = "true";

function generateCustom(): string
{
    global $path;
    $string = $path;
    $custom = ["$string"];
    $invis = array("\u{200D}", "\u{200B}");

    for ($i = 0; $i <= 70; $i++) {
        $random_keys = array_rand($invis);
        $thing = json_decode('"' . $invis[$random_keys] . '"');
        $string .= $thing;
    }

    return $string;
}

if ($user['id']) {
    if (!empty($_FILES['file'])) {

        if ($banned == "true") {
            echo("You are banned from using helist.host!");
        } else if ($banned = "false") {
            if (!file_exists("uploads/$uuid")) {
                mkdir('uploads/' . $uuid, 0777);
            }
            if (!file_exists("uploads/$uuid/$username")) {
                mkdir('uploads/' . $uuid . '/' . $username, 0777);
            }
            $gennedInvite = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
            if ($uploads == 500) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 1000) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 1500) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 2000) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 2500) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 3000) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 3500) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 4000) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 4500) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            } else if ($uploads == 5000) {
                $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $gennedInvite . "', '" . $username . "');";
                $result = mysqli_query($db, $sql);
            }
            $rnd = rndFileName(8);
            if ($filename_type == "short") {
                $rnd = rndFileName(8);
                $hash = $rnd . "." . $type;
                $smallHash = $rnd;
            } else if ($filename_type == "long") {
                $rnd = rndFileName(16);
                $hash = $rnd . "." . $type;
                $smallHash = $rnd;
            }
            $hash = $rnd . "." . $type;
            $type = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            $original_filename = $_FILES['file']['name'];
            $fileurl = $protocol . DOMAIN . DIRECTORY . "uploads/$hash.$type";
            $filelocation = __DIR__ . "uploads/$hash.$type";
            if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $uuid . "/$username/" . $hash)) {
                $sql = "SELECT * FROM users WHERE secret=" . $secret;
                $result = mysqli_query($db, $sql);
                $user = mysqli_fetch_assoc($result);
                $uuid = $user['uuid'];
                $source = "direct/.htaccess";
                $destination = 'uploads/' . $uuid . '/.htaccess';
                copy($source, $destination);
                $destination = 'uploads/' . $uuid . '/' . $username . '/.htaccess';
                copy($source, $destination);
                date_default_timezone_set('Europe/Berlin');
                $date = date("F d, Y h:i:s A");
                $sql = "UPDATE `users` SET `last_uploaded`='$date' WHERE `username`='$username'";
                $result = mysqli_query($db, $sql);
                $sql1 = "UPDATE `users` SET uploads=" . $uploads . " WHERE secret=" . $secret;
                $result1 = mysqli_query($db, $sql1);
                $source = "uploads/" . $hash;
                $destination = 'uploads/' . $uuid . '/' . $username . "/" . $hash;
                if ($use_embed == "true") {
                    $hash_filename_emoji = generateRandomEmoji($hash_filename);
                    $hash_filename_sus = generateRandomSus($hash_filename);
                    $hash_filename = generateInvisible($hash_filename);
                    $hash_filename_custom = generateCustom($hash_filename);
                    $fileurl = $protocol . DOMAIN . DIRECTORY . "uploads/$hash";
                    $files = scandir('uploads/');
                    $filesize = human_filesize(filesize('uploads/' . $uuid . '/' . $username . "/" . $hash), 2);

                    $filesize_placeholder = "%filesize";
                    $filename_placeholder = "%filename";
                    $username_placeholder = "%username";
                    $userid_placeholder = "%id";
                    $date_placeholder = "%date";
                    $date_placeholder = "%date";
                    $uploads_placeholder = "%uploads";
                    if (strpos($emdesc, "'") !== false) {
                        $newdesc = str_replace("'", " ", $emdesc);
                        $emdesc = $newdesc;
                    }
                    $delete_secret = generateSecret(16);
                    // Description Placeholders
                    if (strpos($emdesc, $filename_placeholder) !== false) {
                        $newdesc = str_replace("%filename", $hash, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $filesize_placeholder) !== false) {
                        $newdesc = str_replace("%filesize", $filesize, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $username_placeholder) !== false) {
                        $newdesc = str_replace("%username", $username, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $userid_placeholder) !== false) {
                        $newdesc = str_replace("%id", $userid, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $date_placeholder) !== false) {
                        $newdesc = str_replace("%date", $date, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $uploads_placeholder) !== false) {
                        $newdesc = str_replace("%uploads", $uploads, $emdesc);
                        $emdesc = $newdesc;
                    }

                    // Author Placeholders
                    if (strpos($emauthor, "'") !== false) {
                        $newauthor = str_replace("'", " ", $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $filename_placeholder) !== false) {
                        $newauthor = str_replace("%filename", $hash, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $filesize_placeholder) !== false) {
                        $newauthor = str_replace("%filesize", $filesize, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $username_placeholder) !== false) {
                        $newauthor = str_replace("%username", $username, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $userid_placeholder) !== false) {
                        $newauthor = str_replace("%id", $userid, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $date_placeholder) !== false) {
                        $newauthor = str_replace("%date", $date, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $uploads_placeholder) !== false) {
                        $newauthor = str_replace("%uploads", $uploads, $emauthor);
                        $emauthor = $newauthor;
                    }

                    // Title Placeholders
                    if (strpos($emtitle, $filename_placeholder) !== false) {
                        $newtitle = str_replace("%filename", $hash, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $filesize_placeholder) !== false) {
                        $newtitle = str_replace("%filesize", $filesize, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $username_placeholder) !== false) {
                        $newtitle = str_replace("%username", $username, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $userid_placeholder) !== false) {
                        $newtitle = str_replace("%id", $userid, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $date_placeholder) !== false) {
                        $newtitle = str_replace("%date", $date, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $uploads_placeholder) !== false) {
                        $newtitle = str_replace("%uploads", $uploads, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, "'") !== false) {
                        $newtitle = str_replace("'", " ", $emtitle);
                        $emtitle = $newtitle;
                    }

                    // Description Placeholders
                    if (strpos($uploadToDomain, $filename_placeholder) !== false) {
                        $newDomain = str_replace("%filename", $hash, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $filesize_placeholder) !== false) {
                        $newDomain = str_replace("%filesize", $filesize, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $username_placeholder) !== false) {
                        $newDomain = str_replace("%username", $username, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $userid_placeholder) !== false) {
                        $newDomain = str_replace("%id", $userid, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $date_placeholder) !== false) {
                        $newDomain = str_replace("%date", $date, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $uploads_placeholder) !== false) {
                        $newDomain = str_replace("%uploads", $uploads, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if ($use_customdomain == "true") {
                        if ($url_type == "short") {
                            if ($invisible_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" . $hash_filename;
                                $hash_filename_db = urlencode($hash_filename);
                            } else if ($emoji_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_emoji;
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else if ($sus_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_sus;
                                $hash_filename_db = urlencode($hash_filename_sus);
                            } else if ($custom_path == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_custom;
                                $hash_filename_db = urlencode($hash_filename_custom);
                            } else if ($use_spoofed_domain == "true") {
                                echo("<https://$spoofed_domain>||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||https://" . DOMAIN . DIRECTORY . "/" . $hash);
                            } else {
                                echo("https://$uploadToDomain" . DIRECTORY . "/" . $hash);
                            }

                        } else if ($url_type == "long") {
                            if ($invisible_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" . $hash_filename;
                                $hash_filename_db = urlencode($hash_filename);
                            } else if ($emoji_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_emoji;
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else if ($sus_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_sus;
                                $hash_filename_db = urlencode($hash_filename_sus);
                            } else if ($shurk_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_shurk;
                                $hash_filename_db = urlencode($hash_filename_shurk);
                            } else if ($custom_path == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_custom;
                                $hash_filename_db = urlencode($hash_filename_custom);
                            } else if ($use_spoofed_domain == "true") {
                                echo("<https://$spoofed_domain>||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||https://" . DOMAIN . DIRECTORY . "/" . $hash);
                            } else {
                                echo("https://$uploadToDomain" . DIRECTORY . "/" . $hash);
                            }
                        }
                    } else {
                        if ($url_type == "short") {
                            if ($invisible_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" . $hash_filename);
                                $hash_filename_db = urlencode($hash_filename);
                            } else if ($emoji_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_emoji);
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else if ($sus_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_sus);
                                $hash_filename_db = urlencode($hash_filename_sus);
                            } else if ($custom_path == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_custom);
                                $hash_filename_db = urlencode($hash_filename_custom);
                            } else if ($use_spoofed_domain == "true") {
                                echo("<https://$spoofed_domain>||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||https://" . DOMAIN . DIRECTORY . "/" . $hash);
                            } else {
                                echo("https://" . DOMAIN . DIRECTORY . "/" . $hash);
                            }
                        } else if ($url_type == "long") {
                            if ($invisible_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" . $hash_filename);
                                $hash_filename_db = urlencode($hash_filename);
                            } else if ($emoji_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_emoji);
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else if ($sus_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_sus);
                                $hash_filename_db = urlencode($hash_filename_sus);
                            } else if ($shurk_url == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_shurk);
                                $hash_filename_db = urlencode($hash_filename_shurk);
                            } else if ($custom_path == "true") {
                                echo("https://" . DOMAIN . DIRECTORY . "/" .  $hash_filename_custom);
                                $hash_filename_db = urlencode($hash_filename_custom);
                            } else if ($use_spoofed_domain == "true") {
                                echo("<https://$spoofed_domain>||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||||​||https://" . DOMAIN . DIRECTORY . "/" . $hash);
                            } else {
                                echo "https://" . DOMAIN . DIRECTORY . "/" . $hash;
                            }
                        }
                    }
                    $query54 = "INSERT INTO `uploads` (`id`, `userid`, `username`, `filename`, `hash_filename`, `original_filename`, `filesize`, `delete_secret`, `self_destruct_upload`, `embed_color`, `embed_author`, `embed_title`, `embed_desc`,`uploaded_at`) VALUES (NULL,'" . $userid . "', '" . $username . "', '" . $hash . "', '$hash_filename_db', '" . $original_filename . "', '" . $filesize . "', '" . $delete_secret . "', '" . $self_destruct_upload . "', '" . $emcolor . "', '" . $emauthor . "', '" . $emtitle . "', '" . $emdesc . "', '" . $date . "');";
                    $result54 = mysqli_query($db, $query54);
                    $filesize = human_filesize(filesize('uploads/' . $uuid . '/' . $username . "/" . $hash), 2);

                    if (!empty($webhook)) {
                        $wurl = $webhook;

                        $json_data = json_encode([
                            "username" => "$username | Logs",
                            "avatar_url" => "https://helist.host/assets/img/preview.png",
                            "tts" => false,

                            "embeds" => [[
                                "type" => "rich",
                                "url" => "https://helist.host/" . $hash,
                                "color" => hexdec(str_replace("#", "", $emcolor)),
                                "footer" => [
                                    "text" => "https://helist.host/uploads/$uuid/$username/$hash"
                                ],

                                "author" => [
                                    "name" => "$username [Press to Delete]",
                                    "url" => "https://helist.host/dashboard/images/?delete=$hash&secret=$delete_secret",
                                ],

                                "image" => [
                                    "url" => "https://helist.host/uploads/$uuid/$username/$hash"
                                ],

                                "fields" => [
                                    [
                                        "name" => "Filename",
                                        "value" => "$original_filename",
                                        "inline" => true
                                    ],
                                    [
                                        "name" => "Filesize",
                                        "value" => "$filesize",
                                        "inline" => true
                                    ],
                                    [
                                        "name" => "Uploaded At",
                                        "value" => "$date",
                                        "inline" => true
                                    ],
                                    [
                                        "name" => "URL",
                                        "value" => "https://helist.host/uploads/$uuid/$username/$hash",
                                        "inline" => true
                                    ],
                                ]
                            ]]
                        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                        $ch = curl_init($wurl);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-type: application/json'
                        ));
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                        $response = curl_exec($ch);
                        curl_close($ch);
                    }
                } else {
                    $hash_filename_emoji = generateRandomEmoji($hash_filename);
                    $hash_filename = generateInvisible($hash_filename);
                    $fileurl = $protocol . DOMAIN . DIRECTORY . "uploads/$hash";
                    $files = scandir('uploads/');
                    $filesize = human_filesize(filesize('uploads/' . $uuid . '/' . $username . "/" . $hash), 2);

                    $filesize_placeholder = "%filesize";
                    $filename_placeholder = "%filename";
                    $username_placeholder = "%username";
                    $userid_placeholder = "%id";
                    $date_placeholder = "%date";
                    $date_placeholder = "%date";
                    $uploads_placeholder = "%uploads";
                    if (strpos($emdesc, "'") !== false) {
                        $newdesc = str_replace("'", " ", $emdesc);
                        $emdesc = $newdesc;
                    }
                    $delete_secret = generateSecret(16);
                    // Description Placeholders
                    if (strpos($emdesc, $filename_placeholder) !== false) {
                        $newdesc = str_replace("%filename", $hash, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $filesize_placeholder) !== false) {
                        $newdesc = str_replace("%filesize", $filesize, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $username_placeholder) !== false) {
                        $newdesc = str_replace("%username", $username, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $userid_placeholder) !== false) {
                        $newdesc = str_replace("%id", $userid, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $date_placeholder) !== false) {
                        $newdesc = str_replace("%date", $date, $emdesc);
                        $emdesc = $newdesc;
                    }
                    if (strpos($emdesc, $uploads_placeholder) !== false) {
                        $newdesc = str_replace("%uploads", $uploads, $emdesc);
                        $emdesc = $newdesc;
                    }

                    // Author Placeholders
                    if (strpos($emauthor, "'") !== false) {
                        $newauthor = str_replace("'", " ", $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $filename_placeholder) !== false) {
                        $newauthor = str_replace("%filename", $hash, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $filesize_placeholder) !== false) {
                        $newauthor = str_replace("%filesize", $filesize, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $username_placeholder) !== false) {
                        $newauthor = str_replace("%username", $username, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $userid_placeholder) !== false) {
                        $newauthor = str_replace("%id", $userid, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $date_placeholder) !== false) {
                        $newauthor = str_replace("%date", $date, $emauthor);
                        $emauthor = $newauthor;
                    }
                    if (strpos($emauthor, $uploads_placeholder) !== false) {
                        $newauthor = str_replace("%uploads", $uploads, $emauthor);
                        $emauthor = $newauthor;
                    }

                    // Title Placeholders
                    if (strpos($emtitle, $filename_placeholder) !== false) {
                        $newtitle = str_replace("%filename", $hash, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $filesize_placeholder) !== false) {
                        $newtitle = str_replace("%filesize", $filesize, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $username_placeholder) !== false) {
                        $newtitle = str_replace("%username", $username, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $userid_placeholder) !== false) {
                        $newtitle = str_replace("%id", $userid, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $date_placeholder) !== false) {
                        $newtitle = str_replace("%date", $date, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, $uploads_placeholder) !== false) {
                        $newtitle = str_replace("%uploads", $uploads, $emtitle);
                        $emtitle = $newtitle;
                    }
                    if (strpos($emtitle, "'") !== false) {
                        $newtitle = str_replace("'", " ", $emtitle);
                        $emtitle = $newtitle;
                    }

                    // Description Placeholders
                    if (strpos($uploadToDomain, $filename_placeholder) !== false) {
                        $newDomain = str_replace("%filename", $hash, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $filesize_placeholder) !== false) {
                        $newDomain = str_replace("%filesize", $filesize, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $username_placeholder) !== false) {
                        $newDomain = str_replace("%username", $username, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $userid_placeholder) !== false) {
                        $newDomain = str_replace("%id", $userid, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $date_placeholder) !== false) {
                        $newDomain = str_replace("%date", $date, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (strpos($uploadToDomain, $uploads_placeholder) !== false) {
                        $newDomain = str_replace("%uploads", $uploads, $uploadToDomain);
                        $uploadToDomain = $newDomain;
                    }
                    if (isset($_POST["banner_upload"])) {
                        $newhash = str_replace("https://" . DOMAIN . "/", "", $hash);
                        echo $newhash;
                        die();
                    }
                    if ($use_customdomain == "true") {
                        if ($url_type == "short") {
                            if ($invisible_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" . $hash_filename;
                                $hash_filename_db = urlencode($hash_filename);
                            } else if ($emoji_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_emoji;
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" . $hash;
                            }
                        } else if ($url_type == "long") {
                            if ($invisible_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" . $hash_filename;
                                $hash_filename_db = urlencode($hash_filename);
                            } else if ($emoji_url == "true") {
                                echo "https://$uploadToDomain" . DIRECTORY . "/" .  $hash_filename_emoji;
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else {
                                echo "https://" . DOMAIN . "/uploads/$uuid/$username/$hash";
                            }
                        }
                    } else {
                        if ($url_type == "short") {
                            if ($emoji_url == "true") {
                                echo "https://" . DOMAIN . DIRECTORY . "/" . $hash_filename_emoji;
                                $hash_filename_db = urlencode($hash_filename_emoji);
                            } else if ($invisible_url == "true") {
                                echo "https://" . DOMAIN . DIRECTORY . "/" . $hash_filename;
                                $hash_filename_db = urlencode($hash_filename);
                            } else {
                                echo "https://" . DOMAIN . DIRECTORY . "/" . $hash;
                            }
                        } else if ($url_type == "long") {
                            echo "https://" . DOMAIN . "/uploads/$uuid/$username/$hash";
                        }
                    }
                    $query54 = "INSERT INTO `uploads` (`id`, `userid`, `username`, `filename`, `hash_filename`, `original_filename`, `filesize`, `delete_secret`, `self_destruct_upload`, `embed_color`, `embed_author`, `embed_title`, `embed_desc`, `uploaded_at`) VALUES (NULL,'" . $userid . "', '" . $username . "', '" . $hash . "', '$hash_filename_db', '" . $original_filename . "', '" . $filesize . "', '" . $delete_secret . "', '" . $self_destruct_upload . "', '', '', '', '', '" . $date . "');";
                    $result54 = mysqli_query($db, $query54);
                    $filesize = human_filesize(filesize('uploads/' . $uuid . '/' . $username . "/" . $hash), 2);
                }
            }
        } else {
            echo "Failed to upload your file.";
        }
    }
} else {
    echo "Unknown User";
}
