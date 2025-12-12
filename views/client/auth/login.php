<?php
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../../../autoload.php';
if(isset($_GET['action']) && $_GET['action'] == 'login_facebook'){
$fb = new Facebook\Facebook([
  'app_id' => '1290514812929698', 
  'app_secret' => 'de94d39c2646632fb85d7d224ecede58',
  'default_graph_version' => 'v19.0',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','public_profile']; 
$loginUrl = $helper->getLoginUrl('http://localhost:3000/views/client/auth/fb-callback.php', $permissions);
echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
header('location:'. $loginUrl . '');
exit;
}
if(isset($_GET['action']) && $_GET['action'] == 'login_google'){
    $client = clientGoogle();
    $url = $client->createAuthUrl();
    echo $url;
    header('location:'. $url . '');
    exit;
}
$user = $_POST['user']??'';
$pass = $_POST['pass']??'';


    $DB = new DB();
    $sql = "select * from users where username = ? and password = ?";
    $data = $DB->select($sql, [$user, $pass])[0];
    
if($data != null){
    $_SESSION['user_login']=$user;
    $_SESSION['user_info']=$data;
    

    
    header('location:../../../index.php');
    exit;
}

    $sql = "select * from admin where username = ? and password = ?";
    $data = $DB->select($sql, [$user, $pass]);
    
   if($data != null){
    $_SESSION['admin_login']=$user;
    $_SESSION['admin_info']=$data;
    header('location:../../admin/index.php');
    exit;
}
 header('location:login.html');
?>