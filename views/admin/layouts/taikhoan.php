<?php
if (!isset($_SESSION)) session_start();
 if (!isset($_SESSION['admin_login'])) {
    header('location: ../../client/auth/login.html');
    exit; 
}
 ?>
 <h1>Thông tin tài khoản</h1>
 <div  style="margin:20px 100px">
                    
                    <h3>Username: <?php echo $_SESSION['admin_info'][0]['username'] ?></h3>
                    <p>Tên người dùng: <?php echo $_SESSION['admin_info'][0]['ten_ad'] ?></p>
                    <p>Email: <?php echo $_SESSION['admin_info'][0]['email'] ?></p>
                    <p>Số điện thoại: <?php echo $_SESSION['admin_info'][0]['sdt'] ?></p>
                    <p>Địa chỉ: <?php echo $_SESSION['admin_info'][0]['dia_chi'] ?></p>
                    </div>