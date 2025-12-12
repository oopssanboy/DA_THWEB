<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['admin_login'])) {
    header('location: ../../views/client/auth/login.html');
    exit; 
}
require_once __DIR__ . '/../autoload.php';
$order = new Order();
$order_item = new Order_item();
$dd_sp = new Dacdiem_sp();

if (isset($_GET['action']) && $_GET['action'] == 'confirm') {
    if ($_GET['trangthai'] == 'choxuly') {
        $ma_dh = $_GET['id'];
        $trangthai = 'daxacnhan';
        $order->update_order($ma_dh, $trangthai);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sl_trangthai']) && $_GET['action'] == 'save') {
    $ma_dh = $_GET['id'];
    $trangthai_moi = $_POST['sl_trangthai'];
    $trangthai_cu = $_GET['trangthai'];

    $list_item = $order_item->getAll_orderitem_byid_dh($ma_dh);
    $flag = 0;

    foreach ($list_item as $it) {
        $info_product = $dd_sp->getAll_byid_sp($it['ma_sp']);
        foreach ($info_product as $pr) {
            if ($it['size'] == $pr['size'] && $it['loai_mau'] == $pr['loai_mau']) {
                if (($pr['soluong_tonkho'] - $it['soluong']) >= 0) {
                    $flag++;
                } else {
                    header('location:../../../index.php');
                    exit;
                }
            }
        }
    }

    if ($trangthai_moi != 'huy' && $trangthai_cu == 'huy') {
        if ($flag > 0) {
            foreach ($list_item as $item) {
                $dd_sp->update_tonkho($item['ma_sp'], $item['size'], $item['loai_mau'], $item['soluong'], 'giam');
            }
        }
        $order->update_order($ma_dh, $trangthai_moi);
    } else if ($trangthai_moi != 'huy' && $trangthai_cu != 'huy') {
        $order->update_order($ma_dh, $trangthai_moi);
    }
} else if (isset($_GET['action']) && $_GET['action'] == 'cancel') {
    $ma_dh = $_GET['id'];
    $trangthai = $_GET['trangthai'];
    
    if ($trangthai != 'huy') {
        $list_item = $order_item->getAll_orderitem_byid_dh($ma_dh);
        $flag = 0;

        foreach ($list_item as $it) {
            $flag++; 
        }

        if ($flag > 0) {
            foreach ($list_item as $item) {
                $dd_sp->update_tonkho($item['ma_sp'], $item['size'], $item['loai_mau'], $item['soluong'], 'tang');
            }
        }
        
        $order->update_order($ma_dh, 'huy');
    }
}

header("location:../views/admin/index.php?action=donhang");
exit;
?>