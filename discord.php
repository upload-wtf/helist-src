<?php

include "./src/database.php";
include "./src/config.php";
include "./src/functions.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300);

error_reporting(E_ALL);

define('OAUTH2_CLIENT_ID', '886563642127052860'); // add your discord client id
define('OAUTH2_CLIENT_SECRET', '9aitXFPxjKvgi_955HjxEdi1xcXCmai4'); // add your discord client secret

$authorizeURL = 'https://discord.com/api/oauth2/authorize';
$tokenURL = 'https://discord.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';




if (!isset($_SESSION['loggedin'])) {
     die(
         "You are not logged in. Please <a href='https://helist.host/login'>login</a>."
     );
 }

if(get('code')) {

  $token = apiRequest($tokenURL, array(
    "grant_type" => "authorization_code",
    'client_id' => OAUTH2_CLIENT_ID,
    'client_secret' => OAUTH2_CLIENT_SECRET,
    'redirect_uri' => 'https://helist.host/discord',
    'code' => get('code')
  ));
  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;


  header('Location: ' . $_SERVER['PHP_SELF']);
}

if(session('access_token')) {
  $user = apiRequest($apiURLBase);
 
  $headers = array(
            'Content-Type: application/json',
            'Authorization: Bot ODg2NTYzNjQyMTI3MDUyODYw.GuB24D.eAYGkt27FG-mO7KwawsRzu-Xu3Bk-iFt-A0Cm4'
        );
        $data = array("access_token" => session('access_token'));
    $data_string = json_encode($data);
	
                $url = "https://discord.com/api/guilds/965415360109109259/members/". $user->id; 
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
                curl_exec($ch);
                curl_close($ch);

                if ($_SESSION['loggedin']) {
                    $sql = "UPDATE users SET discord_username = '$user->username', discord_id = '$user->id' WHERE username = '$_SESSION[username]';";
                    $result = mysqli_query($db, $sql);
                    $role = '1002213662175543397';
                    $_SESSION['linked_dc'] = true;
                }


    $url = "https://discord.com/api/guilds/965415360109109259/members/". $user->id. "/roles/{$role}";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
	curl_exec($ch);
    curl_close($ch);
    

} else {
  die("Not logged into Discord!");
}

if(get('action') == 'logout') {
  $url = "https://discord.com/api/guilds/965415360109109259/members/". $user->id;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bot ODg2NTYzNjQyMTI3MDUyODYw.GuB24D.eAYGkt27FG-mO7KwawsRzu-Xu3Bk-iFt-A0Cm4'
  ));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
  curl_exec($ch);
  curl_close($ch);
  unset($_SESSION['access_token']);
  header('Location: ' . $_SERVER['PHP_SELF']);
  die();
}

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);


  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token'); 

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

function logout($url, $data=array()) {
  $ch = curl_init($url);
  curl_setopt_array($ch, array(
      CURLOPT_POST => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
      CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
      CURLOPT_POSTFIELDS => http_build_query($data),
  ));
  $response = curl_exec($ch);
  return json_decode($response);
}

function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

echo '<html>
<head>

<script>
window.location.href = "https://helist.host/dashboard/settings";
</script>

</head>
</html>';