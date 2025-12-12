<?php 
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../../../autoload.php';
$user = new User();
$fb = new Facebook\Facebook([
  'app_id' => '1290514812929698', 
  'app_secret' => 'de94d39c2646632fb85d7d224ecede58',
  'default_graph_version' => 'v19.0',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Exception $e) {
  exit('Lỗi SDK: ' . $e->getMessage());
}

if (! isset($accessToken)) {
  header('location: ../../../views/client/auth/login.html');
  exit;
}
try {
  $response = $fb->get('/me?fields=id,name,email,picture', $accessToken);
  $fbUser = $response->getGraphUser();
} catch(Exception $e) {
  exit('Lỗi Graph: ' . $e->getMessage());
}

$fb_email = $fbUser['email'] ?? null;
$fb_name = $fbUser['name'];
$fb_token_str = (string) $accessToken;

if (empty($fb_email)) {
    echo "Không tìm thấy email từ Facebook.";
    exit;
}
$info = $user->check_user_by_username($fb_email);

if (!empty($info)) {
    $user_data = $info[0];
    $ma_kh = $user_data['ma_kh'];
    $user->update_token($ma_kh, $fb_token_str);
    $_SESSION['ma_kh'] = $ma_kh;
    $_SESSION['user_login'] = $user_data['username'];
    $_SESSION['user_info'] = $user_data;
    $_SESSION['fb_access_token'] = $fb_token_str;

    header('location: ../../../index.php');
    exit;

} else {
    $ma_kh = $user->add_user_google($fb_name, $fb_email, $fb_token_str);
    if ($ma_kh) {
        $_SESSION['ma_kh'] = $ma_kh;
        $_SESSION['user_login'] = $fb_email;
        $new_user_info = $UserModel->get_user_byid($ma_kh);
        $_SESSION['user_info'] = $new_user_info[0];
        $_SESSION['fb_access_token'] = $fb_token_str;
        
        header('location: ../../../index.php');
        exit;
    } else {
        echo "Lỗi hệ thống: Không thể tạo tài khoản.";
    }
}
?>