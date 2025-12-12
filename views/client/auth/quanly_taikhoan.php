<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user_login'])){
            header('location:/views/client/auth/login.html');
            exit;
         }
require_once __DIR__ . '/../../../autoload.php';
$user = new User();
$user_info = $user->get_user_byid($_SESSION['user_info']['ma_kh'])[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUAN LY TAI KHOAN</title>
    <link rel="stylesheet" href="/views/client/css/style.css">
    <link rel="stylesheet" href="/views/client/css/quanlytaikhoan.css">
</head>
<body>
    <?php include_once '../header/header.php'; ?>
    <div class="account row">
        <div class="left">
            <ul>
                <li><div class="left_top row">
                        <img src="/images/logo_user.png" alt="">
                        <h3><?php echo $user_info['username'] ?></h3>
                        <form method="POST" action="logout.php" >
                    <button type="submit"  >Đăng xuất</button>
                    </form>
                    </div>
                </li>
                <li><div class="left_content">
                    <a href="../../../index.php" >Trang chủ</a>
                    <a href="quanly_taikhoan.php">Thông tin tài khoản</a>
                    <a href="quanly_taikhoan.php?type=change_info">Thay đổi thông tin tài khoản</a>
                    <a href="quanly_taikhoan.php?type=xem_donhang">Xem đơn hàng của bạn</a>
                    <a href="quanly_taikhoan.php?type=change_pass">Đổi mật khẩu</a>
                    
                    </div>
                </li>
                    
               
            </ul>
        </div>
        <?php 
            if(isset($_GET['type']))
            switch ($_GET['type']){
                case 'change_info': 
                    ?>
                    <div class="right">
                    <h1>Chỉnh sửa thông tin tài khoản</h1>
                    <form action="/controler/ql_taikhoan_client_controler.php?method=change_info" method="POST">
                        <div class="right_input">
                            <input type="text" name="ten_kh" placeholder="Nhập tên" required><br>
                            <input type="text" name="email" placeholder="Nhập email" required><br>
                            <input type="text" name="sdt" placeholder="Nhập số điện thoại" required><br>
                            <input type="text" name="dia_chi" placeholder="Nhập địa chỉ" required><br>
                            <button type="submit">Lưu</button>
                        </div>
                    </form>
                    </div>
                    <?php
                    break;
                
                case 'xem_donhang': 
                    ?>
                    <div class="right">
                   <h1>Đơn hàng</h1>
                   <div class="right_item ">
                   <table>
                    <tr class="tittle_table">
                        <th>Mã đơn hàng</th>
                        <th>Tổng sản phầm</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Tùy biến</th>
                    </tr>
                   <?php
                        $data = new Order();
                        $list_order = $data->getAll_Byid_kh($_SESSION['user_info'][0]['ma_kh']);
                        if(count($list_order) > 0 )
                        foreach ($list_order as $oder){
                            ?>
                                <tr class="info">
                                    <td><p><?php echo $oder['ma_dh'] ?></p></td>
                                    <td><p><?php echo $oder['tongsp'] ?></p></td>
                                    <td><p><?php echo number_format($oder['tongtien']); ?><sup>đ</sup></p></td>
                                    <td><p><?php echo $oder['ngay_dat'] ?></p></td>
                                    <td>
                                        <?php   if($oder['trangthai'] == 'choxuly' || $oder['trangthai'] == 'daxacnhan'){ ?>
                                    <p style="background-color: rgb(99, 153, 99)"><?php echo $oder['trangthai'] ?></p></td>
                                    <?php
                                        } else if($oder['trangthai'] == 'huy'){ ?>
                                            <p style="background-color: rgba(172, 81, 53, 1)"><?php echo $oder['trangthai'] ?></p></td>
                                        <?php
                                        }
                                        ?>
                                    
                                    <td>
                                        
                                        <a href="quanly_taikhoan.php?type=xem_chitiet&ma_dh=<?php echo $oder['ma_dh']; ?>" class="btn-view">Xem</a>
                                        <a href="/controler/ql_taikhoan_client_controler.php?action=delete&ma_dh=<?php echo $oder['ma_dh'] ?>&trangthai=<?php echo $oder['trangthai'] ?>" onclick="return confirm('Bạn chắc chắn muốn hủy đơn?');" class="a_del">Hủy</a>
                                    </td>
                                </tr>
                        <?php
                        }
                        else
                            echo '<div class="right_item"><h3>Không có đơn hàng để hiễn thị</h3></div>';
                   ?>
                   </table>
                   </div>
                    </div>
                     <?php
                     break;
                case 'xem_chitiet':
                    $ma_dh = $_GET['ma_dh'];
                    $order_item = new Order_item();
                    $items = $order_item->getAll_orderitem_info_byid($ma_dh);
                    $order_model = new Order();
                    $order_info = $order_model->getByid($ma_dh);
                    ?>
                    <div class="right">
                        <h1>Chi tiết đơn hàng #<?php echo $ma_dh; ?></h1>
                        
                
                        

                        <div class="right_item table-responsive">
                            <table>
                                <tr class="tittle_table">
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>SL</th>
                                    <th>Size</th>
                                    <th>Màu</th>
                                </tr>
                                <?php
                                if (isset($items) && count($items) > 0) {
                                    foreach($items as $item){
                                        echo '<tr>
                                            <td><img src="/images/' . $item['link_hinhanh'] . '" style="width: 80px; height: 80px; border-radius: 8px; object-fit: cover;"></td>
                                            <td>' . $item['tensp'] . '</td>
                                            <td>' . number_format($item['giasp']) . '<sup>đ</sup></td>
                                            <td>' . $item['soluong'] . '</td>
                                            <td>' . $item['size'] . '</td>
                                            <td>' . $item['loai_mau'] . '</td>
                                        </tr>';        
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="5" style="text-align: right; font-weight: bold;">Tổng tiền:</td>
                                    <td style="color: red; font-weight: bold; font-size: 18px;"><?php echo number_format($order_info[0]['tongtien']); ?><sup>đ</sup></td>
                                </tr>
                            </table>
                            
                        </div>
                        <div class="order-info-box">
                            <p><strong>Người nhận:</strong> <?php echo $order_info[0]['ten_kh']; ?></p>
                            <p><strong>Số điện thoại:</strong> <?php echo $order_info[0]['sdt']; ?></p>
                            <p><strong>Địa chỉ:</strong> <?php echo $order_info[0]['diachi_giaohang']; ?></p>
                            <p><strong>Phương thức thanh toán:</strong> <?php if($order_info[0]['phuongthuc_thanhtoan'] == 'bank') echo "Ngân hàng"; else echo "Thanh toán khi nhận hàng"; ?></p>
                            <a href="quanly_taikhoan.php?type=xem_donhang" class="btn-back">Quay lại</a>
                        </div>
                        
                    </div>
                    <?php
                    break;
                case 'change_pass': 
                    ?>
                    <div class="right">
                    <h1>Mật khẩu</h1>
                    <form action="/controler/ql_taikhoan_client_controler.php?method=change_pass" method="POST">
                        <div class="right_input">
                            <p>Chọn mật khẩu mạnh và không sử dụng lại mật khẩu cho các tài khoản khác.</p><br>
                            <label >Password:</label><br><br>
                            <input type="password" name="pass_new" placeholder="Nhập mật khẩu mới" required><br>
                            <label >Confirm password:</label><br><br>
                            <input type="password" name="pass_confirm" placeholder="Xác nhận mật khẩu" required><br>
                            
                            <button type="submit">Đổi mật khẩu</button>
                            
                        </div>
                    </form>
                    </div>
                    <?php
                    break;
                default:
                    break;
            }
            else { ?>
                <div class="right">
                    <h1>Thông tin tài khoản</h1>
                    <p>Tên người dùng: <?php echo $user_info['ten_kh'] ?></p>
                    <p>Email: <?php echo $user_info['email'] ?></p>
                    <p>Số điện thoại: <?php echo $user_info['sdt'] ?></p>
                    <p>Địa chỉ: <?php echo $user_info['dia_chi'] ?></p>
                    </div>
                    <?php
            }
        ?>
</div>
<?php include_once '../footer/footer.php'; ?>
</body>
</html>
 