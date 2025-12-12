
<?php
if (!isset($_SESSION)) session_start();
require_once __DIR__ . '/../autoload.php';
$cate_update = new Category();
if($_SERVER['REQUEST_METHOD'] =='POST' && $_POST['method'] == 'edit'){
    $id = $_POST['id'];
    $ten_dm = $_POST['tendm'];
    echo $id,$tendm;
    
    $cate_update->update_dm($id,$ten_dm);
    header("location:../views/admin/index.php?action=danhmuc");
    exit;
}else if($_SERVER['REQUEST_METHOD'] =='POST' && $_POST['method'] == 'add'){
    $ten_dm = $_POST['tendm'];
    $cate_update->add_dm($ten_dm);
    header("location:../views/admin/index.php?action=danhmuc");
    exit;
}else if(isset($_GET['method']) && $_GET['method'] == 'delete'){
    $id = $_GET['id'];
    $cate_update->del_dm($id);
    header("location:../views/admin/index.php?action=danhmuc");
    exit;
}

?>