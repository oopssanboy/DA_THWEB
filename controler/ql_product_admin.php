<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['admin_login'])) {
    header('location: ../views/client/auth/login.html');
    exit;
}
$errors= [];
require_once __DIR__ . '/../autoload.php';

$product = new Giay();
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $product->delete_product($id);
    header("location: ../views/admin/index.php?action=sanpham");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $method = $_POST['method'];
    $tensp = $_POST['tensp'];
    $motasp = $_POST['motasp'];
    $giasp = $_POST['giasp'];
    $ma_th = $_POST['ma_th'];
    $ma_danhmuc = $_POST['ma_danhmuc'];
    $phan_loai = $_POST['phan_loai'];
    $link_hinhanh = '';
    
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] == 0) {
        $file_name = $_FILES['hinh_anh']['name'];
        $file_size = $_FILES['hinh_anh']['size'];
        $tmp_name = $_FILES['hinh_anh']['tmp_name'];
        $duoi_file = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $dinh_dang = ['jpg','png','gif'];
        $target_dir = dirname(__DIR__) . "/images/";
        $path = $target_dir . $file_name;
        if (!in_array($duoi_file, $dinh_dang)) {
            $errors[] = "Chỉ chấp nhận file jpg, png, gif.";
            } elseif ($file_size > 20 * 1024 * 1024) {
                $errors[] = "File quá lớn (>20MB).";
            } else {
                
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                if (move_uploaded_file($tmp_name, $path)) {
                    $link_hinhanh = $file_name;
                } else {
                    $errors[] = "Lỗi khi lưu file.";
                }
            }
    }

    if ($method == 'add') {
        if ($link_hinhanh == ""){
            $link_hinhanh = 'default.png'; 
        }
        $product->add_product($tensp, $motasp, $giasp, $ma_th, $link_hinhanh, $ma_danhmuc, $phan_loai);
        
    } elseif ($method == 'edit') {
        $id = $_POST['id'];
        $product->update_product($id, $tensp, $motasp, $giasp, $ma_th, $link_hinhanh, $ma_danhmuc, $phan_loai);
    }
    
    header("location: ../views/admin/index.php?action=sanpham");
    exit;
}
?>