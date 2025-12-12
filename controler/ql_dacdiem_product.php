<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['admin_login'])) {
    header('location: ../views/client/auth/login.html');
    exit;
}
require_once __DIR__ . '/../autoload.php';
$dacdiem_sp = new Dacdiem_sp();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $ma_sp = $_POST['ma_sp'];
    $size = $_POST['size'];
    $loai_mau = $_POST['loai_mau'];
    $soluong = $_POST['soluong_tonkho'];
    if (!empty($ma_sp) && !empty($size) && !empty($loai_mau)) {
        $dacdiem_sp->add_dacdiem($ma_sp, $size, $loai_mau, $soluong);
    }
    header("location: ../views/admin/index.php?action=sanpham&method=variant&id=" . $ma_sp);
    exit;
}
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $ma_dacdiem = $_GET['ma_dacdiem']; 
    $ma_sp = $_GET['ma_sp']; 

    $dacdiem_sp->delete_dacdiem($ma_dacdiem);
    
    header("location: ../views/admin/index.php?action=sanpham&method=variant&id=" . $ma_sp);
    exit;
}
?>