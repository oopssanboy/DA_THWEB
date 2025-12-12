<?php
    require_once __DIR__ . '/../../../autoload.php';
        if (!isset($_SESSION)) session_start();
         if (!isset($_SESSION['user_login'])){
            header('location:/views/client/auth/login.html');
            exit;
         }
    ?>
<?php
    $data = new Cart();
    $ma_kh = $_SESSION['user_info']['ma_kh'];
    $list_cart = $data->getAllcart_info_byid($ma_kh);
    $sum_money= 0;
    $sum_product= 0;
    $date_now = date('Y-m-d');
    $date = date('Y-m-d',strtotime('+3 days'));
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>
    <link rel="stylesheet" href="/views/client/css/cart.css">
    <link rel="stylesheet" href="/views/client/css/style.css">
</head>
<body>
    <?php include_once '../header/header.php'; ?>
     <div class="cart row">
        <div class="cart_left">
            <div class="cart_header">
                <h1>Giỏ hàng:</h1>
            </div>
            <div class="cart_left_content">
                <div class="cart_left_item">
                    <?php
                        if($list_cart == null)
                            echo "<p>Giỏ hàng trống</p>";
                        else
                        foreach($list_cart as $cart){
                            $sum_money+= $cart['giasp'] * $cart['soluong'];
                            $sum_product+= $cart['soluong'];
                        ?>
                            <div class="cart_row">
                            <div class="item_cart">
                            <img src="/images/<?php echo $cart['link_hinhanh'] ?>"alt="">
                            <div class="cart_left_item_info">
                            <p><?php echo $cart['tensp']; ?></p>
                            <p>Mô tả: <?php echo $cart['motasp']; ?></p>
                            <p>Giá: <?php echo number_format($cart['giasp']); ?><sup>đ</sup></p>
                            <p>Màu: <?php echo $cart['loai_mau']; ?></p>
                            <p>Size: <?php echo $cart['size']; ?></p>
                            <div class="left_soluong">
                            <p>Số lượng: 
                                <a href="/controler/giohangcontroler.php?action=update_qty&ma_cart=<?php echo $cart['ma_cart']; ?>&type=decrease">&#9866;</a>
                                <?php echo $cart['soluong']; ?>
                                <a href="/controler/giohangcontroler.php?action=update_qty&ma_cart=<?php echo $cart['ma_cart']; ?>&type=increase">&#10010;</a>
                            </p>
                            </div>
                        </div>
                        </div>
                        <div class="cart_left_button">
                            <a href="/controler/giohangcontroler.php?ma_cart=<?php echo $cart['ma_cart']; ?>&action=delete" >Delete</a>
                        </div>
                        
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="cart_right">
            <div class="cart_header">
                <h1>Thông tin đơn hàng:</h1>
            </div>
            <form class="cart_right_item" method="POST" action="/controler/giohangcontroler.php?action=thanhtoan">
                <p><?php echo $sum_product; ?> Sản phẩm</p>
                <h3>Tổng tiền: <?php echo number_format($sum_money); ?><sup>đ</sup></h3>
                <h3>Thông tin giao hàng</h3>
                <input type="text" name="ten_kh" placeholder="Nhập họ và tên" value="<?php echo$_SESSION['user_info']['ten_kh']; ?>"required>
                <input type="tel" name="sdt" placeholder="Nhập số điện thoại" value="<?php echo$_SESSION['user_info']['sdt']; ?>" required><br>
                <input type="email" name="email" placeholder="Nhập email" value="<?php echo$_SESSION['user_info']['email']; ?>" required>
                <input type="text" name="diachi" placeholder="Nhập địa chỉ" value="<?php echo$_SESSION['user_info']['dia_chi']; ?>" required><br>
                
                <h3>Ghi chú đơn hàng</h3>
                
                <textarea name="ghichu"></textarea>
                <h3>Chọn phương thức thanh toán</h3>
                <div class="pt_thanhtoan">
                    <span><input type="radio" name="pttt" value="bank" > &nbsp; &nbsp;<img src="/images/thanhtoan_bank.png" alt=""> &nbsp; &nbsp;Ngân hàng&nbsp;</span><br>
                    <span><input type="radio" name="pttt" value="ttknh" checked> &nbsp; &nbsp;<img src="/images/ttknh.png" alt=""> &nbsp; &nbsp;Thanh toán khi nhận hàng</span><br>
               </div>
                <input type="hidden" name="tongtien" value="<?php echo $sum_money; ?>">
                <input type="hidden" name="tongsp" value="<?php echo $sum_product; ?>">
                <input type="hidden" name="ma_kh" value="<?php echo $cart['ma_kh']; ?>">
                <input type="hidden" name="ngay_dat" value="<?php echo $date_now; ?>">
                <input type="hidden" name="ngay_giaohang" value="<?php echo $date; ?>">
                <div class="button">
                <button type="submit">Thanh toán</button>
                 </div>
            </form>
        </div>
     </div>
    <?php include_once '../footer/footer.php'; ?>
</body>
</html>