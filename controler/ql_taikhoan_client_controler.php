<?php
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../autoload.php';
if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $data_del = new Order();
    $order_item = new Order_item();
    $dacdiem_sp = new Dacdiem_sp();
    $data_item = $order_item->getAll_orderitem_info_byid($_GET['ma_dh']);
    if($_GET['trangthai'] != 'huy' && $_GET['trangthai'] != 'daxacnhan'){
    foreach($data_item as $v){
        $dacdiem_sp->update_tonkho($v['ma_sp'],$v['size'],$v['loai_mau'],$v['soluong'],'tang');
    }
    //$order_item->del_order_item($_GET['ma_dh']);
    //$data_del->del_order_client($_GET['ma_dh']);
    $data_del->update_order($_GET['ma_dh'],'huy');
    }
    header('location:../views/client/auth/quanly_taikhoan.php?type=xem_donhang');
    exit;
}else if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_GET['method']) && $_GET['method'] == 'change_pass'){
    $pass = $_POST['pass_new']??'';
    $passconfirm = $_POST['pass_confirm']??'';
    if ($pass != $passconfirm || empty($passconfirm) || empty($pass)){
        header('location:../views/client/auth/quanly_taikhoan.php?type=change_pass');
        exit;
    }else{
        $DB = new DB();
        $ma_kh = $_SESSION['user_info'][0]['ma_kh'];
        $sql = "update users set password = ? where ma_kh=?" ;
        $DB->update($sql, [$pass,$ma_kh]);
        header('location:../views/client/auth/quanly_taikhoan.php?type=change_pass');
        exit;
    }
}else if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_GET['method']) && $_GET['method'] == 'change_info'){
    $ten_kh = $_POST['ten_kh']??'';
    $email = $_POST['email']??'';
    $sdt = $_POST['sdt']??'';
    $dia_chi = $_POST['dia_chi']??'';
    
    if (empty($ten_kh) || empty($email) || empty($sdt) || empty($dia_chi)){
        header('location:../views/client/auth/quanly_taikhoan.php?type=change_info');
        exit;
    }else{
        $DB = new DB();
        $ma_kh = $_SESSION['user_info'][0]['ma_kh'];
        $sql = "update users set ten_kh = ? , email = ? , sdt = ? , dia_chi = ? where ma_kh=?" ;
        $DB->update($sql, [$ten_kh,$email,$sdt,$dia_chi,$ma_kh]);
        header('location:../views/client/auth/quanly_taikhoan.php?type=change_info');
        exit;
    }
}
header('location:../views/client/auth/quanly_taikhoan.php');
?>