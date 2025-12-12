
<?php

if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user_login'])){
            header('location:../views/client/auth/login.html');
            exit;
         }
require_once __DIR__ . '/../autoload.php';
if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['ma_sp'])){
    $ma_sp = $_POST['ma_sp'];
    $ma_kh = $_SESSION['user_info'][0]['ma_kh'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $soluong = $_POST['soluong'];
    $cart = new Cart();
    $cart->add($ma_kh,$ma_sp,$size,$color,$soluong);
    header("location:../views/client/product/product.php?id=$ma_sp");
    exit;
}else if(isset($_GET['action'])&& $_GET['action']=='delete'){
    $ma_cart = $_GET['ma_cart'];
    $cart = new Cart();
    $cart->del($ma_cart);
    header("location:../views/client/cart/cart.php");
    exit;
}
else if (isset($_GET['action']) && $_GET['action'] == 'update_qty') {
    $ma_cart = $_GET['ma_cart'];
    $type = $_GET['type']; 
    $cart = new Cart();
    $dacdiem_sp = new Dacdiem_sp();
    $cart_item = $cart->getByid($ma_cart);
    if ($cart_item) {
        $current_item = $cart_item[0];
        $current_qty = $current_item['soluong'];
        $new_qty = $current_qty;
        
        if ($type == 'increase') {
            $info_product = $dacdiem_sp->getAll_byid_sp($current_item['ma_sp']);
            $tonkho = 0;
            foreach ($info_product as $pr) {
                if ($current_item['size'] == $pr['size'] && $current_item['loai_mau'] == $pr['loai_mau']) {
                    $tonkho = $pr['soluong_tonkho'];
                    break;
                }
            }

            if ($current_qty < $tonkho) {
                $new_qty++;
            } else {
            }
            
        } elseif ($type == 'decrease') {
            if ($current_qty > 1) {
                $new_qty--;
            }
        }
        if ($new_qty != $current_qty) {
            $cart->update_soluong($ma_cart, $new_qty);
        }
    }
    header("location:../views/client/cart/cart.php");
    exit;
}

else if($_SERVER['REQUEST_METHOD'] =='POST' && $_GET['action']=='thanhtoan'){
   
    $ma_kh =$_POST['ma_kh'];
    $ten_kh =$_POST['ten_kh'];
    $tongtien =$_POST['tongtien'];
    $email =$_POST['email'];
    $tongsp =$_POST['tongsp'];
    $trangthai = 'choxuly';
    $phuongthuc_thanhtoan =$_POST['pttt'];
    $ngay_dat =$_POST['ngay_dat'];
    $ngay_giaohang =$_POST['ngay_giaohang'];
    $diachi_giaohang =$_POST['diachi'];
    $sdt =$_POST['sdt'];

    $_SESSION['user_order']=[$ma_kh,$tongtien,$email,$tongsp,$trangthai,$phuongthuc_thanhtoan,$ngay_dat,$ngay_giaohang,$sdt,$ten_kh,$diachi_giaohang];


    if ($_POST['pttt'] == 'ttknh'){
        $data = new Cart();
        $order = new Order();
        $dacdiem_sp = new Dacdiem_sp();
        $order_item = new Order_item();
        $list_cart = $data->getAllcart_info_byid($ma_kh);
        $flag = 0;
        foreach($list_cart as $it){
            $info_product = $dacdiem_sp->getAll_byid_sp($it['ma_sp']);
            foreach($info_product as $pr){
                if($it['size']==$pr['size'] && $it['loai_mau'] == $pr['loai_mau']){
                    if(($pr['soluong_tonkho'] - $it['soluong']) >= 0){
                        $flag++;
                    }else{
                        header('location:../../../index.php');
                        exit;
                    }
                }
            }
        }
        if($flag > 0){
            $ma_dh = $order->add_order($_SESSION['user_order'][0],$_SESSION['user_order'][1],$_SESSION['user_order'][2],$_SESSION['user_order'][3],$_SESSION['user_order'][4],$_SESSION['user_order'][5],$_SESSION['user_order'][6],$_SESSION['user_order'][7],$_SESSION['user_order'][8],$_SESSION['user_order'][9],$_SESSION['user_order'][10]);
            foreach($list_cart as $item){
                $order_item->add_order_item($item['ma_sp'],$ma_dh, $item['size'],$item['soluong'],$item['giasp'],$item['loai_mau']);
                $dacdiem_sp->update_tonkho($item['ma_sp'],$item['size'],$item['loai_mau'],$item['soluong'],'giam');
            }

            $data->del_byid_kh($ma_kh);
            header('location:../../../index.php');
            exit;
        }
    }else if ($_POST['pttt'] == 'bank'){
         
        $data = new Cart();
        $dacdiem_sp = new Dacdiem_sp();
        $list_cart = $data->getAllcart_info_byid($ma_kh);
        $flag = 0;
        foreach($list_cart as $it){
            $info_product = $dacdiem_sp->getAll_byid_sp($it['ma_sp']);
            foreach($info_product as $pr){
                if($it['size']==$pr['size'] && $it['loai_mau'] == $pr['loai_mau']){
                    if(($pr['soluong_tonkho'] - $it['soluong']) >= 0){
                        $flag++;
                    }else{
                        header('location:../../../index.php');
                        exit;
                    }
                }
            }
        }
        if($flag > 0){
        header("location:../views/client/thanhtoan/thanhtoan.php");
        exit;
        }
    }else{
        header("location:../views/client/cart/cart.php");
        exit;
    }
}else if($_SERVER['REQUEST_METHOD'] =='POST' && $_GET['action']=='dathanhtoan'){
    $data = new Cart();
    $order = new Order();
    $dacdiem_sp = new Dacdiem_sp();
    $order_item = new Order_item();
    $list_cart = $data->getAllcart_info_byid($_SESSION['user_order'][0]);
    $flag = 0;
    $ma_dh = $order->add_order($_SESSION['user_order'][0],$_SESSION['user_order'][1],$_SESSION['user_order'][2],$_SESSION['user_order'][3],$_SESSION['user_order'][4],$_SESSION['user_order'][5],$_SESSION['user_order'][6],$_SESSION['user_order'][7],$_SESSION['user_order'][8],$_SESSION['user_order'][9],$_SESSION['user_order'][10]);
    foreach($list_cart as $item){
        $order_item->add_order_item($item['ma_sp'],$ma_dh, $item['size'],$item['soluong'],$item['giasp'],$item['loai_mau']);
        $dacdiem_sp->update_tonkho($item['ma_sp'],$item['size'],$item['loai_mau'],$item['soluong'],'giam');
    }
    $data->del_byid_kh($_SESSION['user_order'][0]);
    header('location:../../../index.php');
    exit;
}else{
    header('location:../../../index.php');
    exit;
}


?>

