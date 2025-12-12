<?php
    if (!isset($_SESSION['admin_login'])) {
    header('location: ../../client/auth/login.html');
    exit; 
}
?>
<table>
    <tr>
        <th></th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Mô tả</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Size</th>
        <th>Màu</th>
    </tr>
 <?php
        $order_item = new Order_item();
        $data = $order_item->getAll_orderitem_info_byid($ma_dh_get);
        $order_detail = $order->getByid($ma_dh_get);
        if (isset($data) && count($data) > 0) {
                                            
            foreach($data as $od_item){
                echo '<tr>
                        <td> <img src="/images/' . $od_item['link_hinhanh'] . '" style="width: 60px; height: 60px; border-radius: 12px; object-fit: cover;"></td>
                        <td>' . $od_item['ma_sp'] . '</td>
                        <td>' . $od_item['tensp'] . '</td>
                        <td>' . $od_item['motasp'] . '</td>
                        <td>' . number_format($od_item['giasp']) . '<sup>đ</sup></td>
                        <td>' . $od_item['soluong'] . '</td>
                        <td>' . $od_item['size'] . '</td>
                        <td>' . $od_item['loai_mau'] . '</td>
                        
                    </tr>';        
            }
         } else {
                echo "Chưa có chi tiết đơn hàng nào!!!";
        }
    ?>
</table>
<div style="text-align:center">
    <h1>Thông tin đơn hàng</h1>
  <form action="../../../controler/ql_order_admin.php?action=save&id=<?php echo $order_detail[0]['ma_dh'] ?>&trangthai=<?php echo $order_detail[0]['trangthai'] ?>" method="POST">
    <table>
        <tr >
            <th style="background-color: red;">Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Phương thức thanh toán</th>
            <th>Ngày đặt</th>
            <th>Địa chỉ giao hàng</th>
            <th>Tổng sản phẩm</th>
            <th>Tổng Tiền</th>
            <th>Trạng thái</th>
        </tr>
        <tr>
            <td><?php echo $order_detail[0]['ma_dh'] ?></td>
            <td><?php echo $order_detail[0]['ten_kh'] ?></td>
            <td><?php echo $order_detail[0]['sdt'] ?></td>
            <td><?php echo $order_detail[0]['email'] ?></td>
            <td><?php echo $order_detail[0]['phuongthuc_thanhtoan'] ?></td>
            <td><?php echo $order_detail[0]['ngay_dat'] ?></td>
            <td><?php echo $order_detail[0]['diachi_giaohang'] ?></td>
            <td><?php echo $order_detail[0]['tongsp'] ?></td>
            <td><?php echo number_format($order_detail[0]['tongtien']) ?><sup>đ</sup></td>
            <td>
            <select name="sl_trangthai" style="widght:20px;">
                <option value="<?php echo $order_detail[0]['trangthai'] ?>"><?php echo $order_detail[0]['trangthai'] ?></option>
                <?php if($order_detail[0]['trangthai'] == 'choxuly'){ ?>
                <option value="daxacnhan">Xác nhận</option>
                <?php
                }else if($order_detail[0]['trangthai'] == 'huy'){
                ?>
                <option value="choxuly">Chờ xử lý</option>
                <option value="daxacnhan">Xác nhận</option>
                <?php
                }else {
                ?>
                <option value="choxuly">Chờ xử lý</option>
                <?php
                }
                ?>
            </select>
            </td>
        </tr>
    </table>
    <a href="../../../controler/ql_order_admin.php?action=confirm&id=<?php echo $order_detail[0]['ma_dh'] ?>&trangthai=<?php echo $order_detail[0]['trangthai'] ?>" class="btn btn-xem">Xác nhận</a> 
    <button type="submit" class="btn btn-xem">Lưu</button> 
    <a href="index.php?action=donhang" class="btn btn-xem">Quay lại</a> 
    </form>
    
</div>
                            
                        
