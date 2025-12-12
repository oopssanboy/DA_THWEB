<?php
    if (!isset($_SESSION)) session_start();
        unset($_SESSION['admin_login']);
         unset($_SESSION['admin_data']);
         unset($_SESSION['user_login']);
         unset($_SESSION['user_data']);
    header('location:login.html');
?>

    


