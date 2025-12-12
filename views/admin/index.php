<?php
if (!isset($_SESSION)) session_start();
ob_start();
if (!isset($_SESSION['admin_login'])) {
    header('location: ../../views/client/auth/login.html');
    exit; 
}
require_once '../../autoload.php';
$cate = new Category();
$order = new Order();
$product = new Giay();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="layouts/header.css">
    <link rel="stylesheet" href="layouts/danhmuc.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include_once 'layouts/header.php' ?>
    <div>
        <?php 
           if(isset($_GET['action'])){
                switch ($_GET['action']) {
                    case 'danhmuc':
                        
                            if(isset($_GET['method']) && $_GET['method'] == 'edit'){
                                if(isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $dm_can_sua = $cate->getByid_dm($id);
                                }
                            ?>
                                <div class="main">
                                <h2>Quản Lý Danh mục</h2>
                                <form action="../../controler/ql_category_controler.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $dm_can_sua[0]['ma_danhmuc']; ?>">
                                
                                <input type="text" name="tendm" value="<?php echo $dm_can_sua[0]['ten_danhmuc']; ?>">
                                <input type="hidden" name="method" value="edit">
                                <input type="submit" value="Cập nhật">
                                </form>
                                <?php
                            }else {
                                ?>
                                <div class="main">
                                <h2>Quản Lý Danh mục</h2>
                                <form action="../../controler/ql_category_controler.php" method="POST">
                                <input type="text" name="tendm" id="">
                                 <input type="hidden" name="method" value="add">
                                <input type="submit" value="Thêm mới">
                                </form>
                        <?php
                            } ?>
                                <br>
                                <table>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã danh mục</th>
                                        <th>Tên danh mục</th>
                                        <th>Tùy chỉnh</th>
                                    </tr>
                                <?php
                                        $result = $cate->getALL_dm();
                                        if (isset($result) && count($result) > 0) {
                                            $i=1;
                                            foreach($result as $dm){
                                                echo '<tr>
                                                        <td>' . $i . '</td>
                                                        <td>' . $dm['ma_danhmuc'] . '</td>
                                                        <td>' . $dm['ten_danhmuc'] . '</td>
                                                        <td> 
                                                            <a href="index.php?action=danhmuc&method=edit&id='.$dm['ma_danhmuc'].'" class="btn btn-sua">Sửa</a> 
                                                            <a href="../../controler/ql_category_controler.php?action=danhmuc&method=delete&id='.$dm['ma_danhmuc'].'"class="btn btn-xoa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');">Xóa</a>
                                                        </td>
                                                    </tr>';
                                                $i++;
                                            }
                                        } else {
                                            echo "Chưa có danh mục nào!!!";
                                        }
                                    ?>
                                </table>
                            </div>
                    <?php
                        break;
                   case 'sanpham':
                        if(isset($_GET['method']) && $_GET['method'] == 'add' || isset($_GET['method']) && $_GET['method'] == 'edit' || isset($_GET['method']) && $_GET['method'] == 'variant'){
                            include_once 'layouts/add_edit_product.php';
                            break;
                        }else{
                        ?>
                            <div style="margin: 20px;">
                                <h2>Quản Lý Sản Phẩm</h2>
                                <a href="index.php?action=sanpham&method=add" class="btn" style="background-color: #04AA6D; padding: 10px 20px;">+ Thêm sản phẩm mới</a>
                            </div>
                            <table>
                                <tr>
                                    <th>Mã SP</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Thương hiệu</th>
                                    <th>Danh mục</th>
                                    <th>Tùy biến</th>
                                </tr>
                                <?php
                                $result = $product->getALL();
                                if (isset($result) && count($result) > 0) {
                                    foreach ($result as $pro) {
                                        echo '<tr>
                                                <td>' . $pro['ma_sp'] . '</td>
                                                <td><img src="../../images/' . $pro['link_hinhanh'] . '" style="width: 60px; height: 60px; object-fit: cover;"></td>
                                                <td style="text-align: left;">' . $pro['tensp'] . '</td>
                                                <td>' . number_format($pro['giasp']) . '<sup>đ</sup></td>
                                                <td>' . $pro['ma_th'] . '</td>
                                                <td>' . $pro['ma_danhmuc'] . '</td>
                                                <td> 
                                                    <a href="?action=sanpham&method=edit&id=' . $pro['ma_sp'] . '" class="btn btn-sua">Sửa</a> 
                                                    <a href="?action=sanpham&method=variant&id=' . $pro['ma_sp'] . '" class="btn btn-sua">Biến thể</a> 
                                                    <a href="../../controler/ql_product_admin.php?action=delete&id=' . $pro['ma_sp'] . '" class="btn btn-xoa" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');">Xóa</a>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Chưa có sản phẩm nào!!!</td></tr>";
                                }
                                ?>
                            </table>
                    <?php
                        }
                        break;
                    case 'donhang':
                        if(isset($_GET['method']) && $_GET['method'] == 'watch'){
                            $ma_dh_get=$_GET['id'];
                            include_once 'layouts/watch_order_item.php';
                            break;
                        }else{
                        ?>
                        <h2>Quản Lý Đơn Hàng</h2>
                        <table>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Tổng sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy biến</th>
                                    </tr>
                                <?php
                                        $result = $order->getALL();
                                        if (isset($result) && count($result) > 0) {
                                            
                                            foreach($result as $od){
                                                echo '<tr>
                                                        <td>' . $od['ma_dh'] . '</td>
                                                        <td>' . $od['ten_kh'] . '</td>
                                                        <td>' . $od['tongsp'] . '</td>
                                                        <td>' . number_format($od['tongtien']) . '<sup>đ</sup></td>
                                                        <td>' . $od['ngay_dat'] . '</td>
                                                        <td>' . $od['trangthai'] . '</td>
                                                        
                                                        <td> 
                                                            <a href="index.php?action=donhang&method=watch&id='.$od['ma_dh'].'" class="btn btn-xem">Xem</a> 
                                                            <a href="../../controler/ql_order_admin.php?action=cancel&id='.$od['ma_dh'].'&trangthai=' .$od['trangthai'] .'" class="btn btn-huy" onclick="return confirm(\'Bạn có chắc chắn muốn hủy không?\');">Hủy</a> 
                                                            
                                                        </td>
                                                    </tr>';
                                            }
                                        } else {
                                            echo "Chưa có đơn hàng nào!!!";
                                        }
                                    ?>
                                </table>

                        <?php
                        break;
                            }
                    case 'taikhoan':
                        include "layouts/taikhoan.php";
                        break;
                    default:
                        include "layouts/home.php";
                        break;
                }
            } else{
                include "layouts/home.php";
            }
        ?>
    </div>

    <?php include "layouts/footer.php"; ?>
</body>
</html>





         

