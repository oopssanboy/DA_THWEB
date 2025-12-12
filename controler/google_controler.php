<?php
ob_start();
session_start();
require_once __DIR__ . '/../autoload.php';
$client = clientGoogle();
$service = new Google_Service_Oauth2($client);
$UserModel = new User();

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
     
    if (isset($token['error'])) {
        echo "Lỗi đăng nhập Google: " . $token['error_description'];
    } else {
        $client->setAccessToken($token);
        $google_info = $service->userinfo->get();
        $email = $google_info->email;
        $name = $google_info->name;
        $picture = $google_info->picture;
        $info = $UserModel->check_user_by_username($email); 

        if (empty($info)) {
            // --- TRƯỜNG HỢP 1: NGƯỜI DÙNG MỚI ---
            $token_user = bin2hex(random_bytes(16)); 
            $ma_kh = $UserModel->add_user_google($name, $email, $token_user);
            
            if ($ma_kh) {
                $_SESSION['ma_kh'] = $ma_kh;
                $_SESSION['user_login'] = $email;
                $new_user_info = $UserModel->get_user_byid($ma_kh);
                if (!empty($new_user_info)) {
                     $_SESSION['user_info'] = $new_user_info[0];
                }
                header('location: /index.php');
                exit;
            } else {
                echo "Lỗi hệ thống: Không thể tạo tài khoản vào CSDL.";
            }

        } else {
            // --- TRƯỜNG HỢP 2: ĐÃ CÓ TÀI KHOẢN ---
            
            $_SESSION['ma_kh'] = $info[0]['ma_kh'];
            $_SESSION['user_login'] = $info[0]['username'];
            $_SESSION['user_info'] = $info[0];
            
            header('location: /index.php');
            exit;
            
        }
    }
} else {
    header('location: /../views/client/auth/login.html');
    exit;
}
?>