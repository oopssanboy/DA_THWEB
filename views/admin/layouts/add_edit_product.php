 <?php
  
$cate = new Category();
    $list_dm = $cate->getAll_dm();
    $brand = new Brand();
    $list_brand = $brand->getAll();
    if (isset($_GET['method']) && $_GET['method'] == 'edit') {
        $id = $_GET['id'];
        $sp_can_sua = $product->getByid($id);
        $sp = $sp_can_sua[0]; 
    ?>
 <div class="main">
     <h2>Cập nhật sản phẩm</h2>
     <form action="../../controler/ql_product_admin.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="method" value="edit">
         <input type="hidden" name="id" value="<?php echo $sp['ma_sp']; ?>">

         <label>Tên sản phẩm:</label><br>
         <input type="text" name="tensp" value="<?php echo $sp['tensp']; ?>" required><br><br>

         <label>Mô tả:</label><br>
         <textarea name="motasp" rows="4" style="width: 100%;"><?php echo $sp['motasp']; ?></textarea><br><br>

         <label>Giá:</label><br>
         <input type="number" name="giasp" value="<?php echo $sp['giasp']; ?>" required style="padding: 8px; width: 200px;height:35px"><br><br>

         <label>Danh mục:</label><br>
         <select name="ma_danhmuc" style="padding: 8px; width: 200px;">
             <?php foreach ($list_dm as $dm) { ?>
             <option value="<?php echo $dm['ma_danhmuc']; ?>"
                 <?php if ($sp['ma_danhmuc'] == $dm['ma_danhmuc']) echo 'selected'; ?>>
                 <?php echo $dm['ten_danhmuc']; ?>
             </option>
             <?php } ?>
         </select><br><br>

         <label>Thương hiệu:</label><br>
         <select name="ma_th" style="padding: 8px; width: 200px;">
             <?php foreach ($list_brand as $th) { ?>
             <option value="<?php echo $th['ma_th']; ?>" <?php if ($sp['ma_th'] == $th['ma_th']) echo 'selected'; ?>>
                 <?php echo $th['tenth']; ?>
             </option>
             <?php } ?>
         </select><br><br>

         <label>Phân loại (Nam/Nữ):</label><br>
         <select name="phan_loai" style="padding: 8px; width: 200px;">
             <option value="Nam" <?php if ($sp['phan_loai'] == 'Nam') echo 'selected'; ?>>Nam</option>
             <option value="Nữ" <?php if ($sp['phan_loai'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
         </select><br><br>

         <label>Hình ảnh hiện tại:</label><br>
         <img src="../../images/<?php echo $sp['link_hinhanh']; ?>" style="width: 100px;"><br>
         <label>Chọn ảnh mới (nếu muốn thay đổi):</label><br>
         <input type="file" name="hinh_anh"><br><br>

         <input type="submit" value="Lưu cập nhật">
         <a href="index.php?action=sanpham" class="btn btn-huy" style="background-color: gray;">Hủy</a>
     </form>
 </div>

 <?php
    } elseif (isset($_GET['method']) && $_GET['method'] == 'add') {
    ?>
 <div class="main">
     <h2>Thêm sản phẩm mới</h2>
     <form action="../../controler/ql_product_admin.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="method" value="add">

         <label>Tên sản phẩm:</label><br>
         <input type="text" name="tensp" required><br><br>

         <label>Mô tả:</label><br>
         <textarea name="motasp" rows="4" style="width: 100%;"></textarea><br><br>

         <label>Giá:</label><br>
         <input type="number" name="giasp" required style="padding: 8px; width: 200px;height:35px"><br><br>

         <label>Danh mục:</label><br>
         <select name="ma_danhmuc" style="padding: 8px; width: 200px;">
             <?php foreach ($list_dm as $dm) { ?>
             <option value="<?php echo $dm['ma_danhmuc']; ?>"><?php echo $dm['ten_danhmuc']; ?></option>
             <?php } ?>
         </select><br><br>

         <label>Thương hiệu:</label><br>
         <select name="ma_th" style="padding: 8px; width: 200px;">
             <?php foreach ($list_brand as $th) { ?>
             <option value="<?php echo $th['ma_th']; ?>"><?php echo $th['tenth']; ?></option>
             <?php } ?>
         </select><br><br>

         <label>Phân loại:</label><br>
         <select name="phan_loai" style="padding: 8px; width: 200px;">
             <option value="Nam">Nam</option>
             <option value="Nữ">Nữ</option>
         </select><br><br>

         <label>Hình ảnh:</label><br>
         <input type="file" name="hinh_anh" required><br><br>

         <input type="submit" value="Thêm mới">
         <a href="index.php?action=sanpham" class="btn btn-huy" style="background-color: gray;">Hủy</a>
     </form>
 </div>

 <?php
    }elseif (isset($_GET['method']) && $_GET['method'] == 'variant'){
        $id_sp = $_GET['id'];
    $dacdiem_sp = new Dacdiem_sp();
    $product_model = new Giay();
    $sp = $product_model->getByid($id_sp)[0];
    $list_dacdiem_sp = $dacdiem_sp->getAll_byid_sp($id_sp);
    ?>
    <div class="main">
        <h2>Quản lý biến thể: <?php echo $sp['tensp']; ?>  #<?php echo $sp['ma_sp']; ?></h2>
        <a href="index.php?action=sanpham" class="btn btn-huy" style="background-color: #059862;">Quay lại danh sách SP</a>
        
        <div style="margin-top: 20px; padding: 15px; border: 1px solid #ddd; background-color: #f9f9f9;">
            <h3>Thêm Size | Màu | Số lượng mới</h3>
            <form action="../../controler/ql_dacdiem_product.php" method="POST">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="ma_sp" value="<?php echo $id_sp; ?>">
                
                <div style="display: flex; gap: 15px;">
                    <div>
                        <label>Size:</label><br>
                        <select name="size"  required style="width: 130px;height: 35px;">
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                        </select>
                    </div>
                    <div>
                        <label>Màu sắc:</label><br>
                        <select name="loai_mau"  required style="width: 130px;height: 35px;">
                            <option value="Đỏ">Đỏ</option>
                            <option value="Vàng">Vàng</option>
                            <option value="Trắng">Trắng</option>
                            <option value="Đen">Đen</option>
                            <option value="Xanh">Xanh</option>
                        </select>
                    </div>
                    <div>
                        <label>Số lượng tồn kho:</label><br>
                        <input type="number" name="soluong_tonkho" min="1" required style="width: 130px; height:35px">
                    </div>
                    <div style="align-self: flex-end;">
                        <input type="submit" value="Thêm" style="margin-top: 0;">
                    </div>
                </div>
            </form>
        </div>

        <br>
        <h3>Danh sách đang có</h3>
        <table>
            <tr>
                <th>Mã đặc điểm</th>
                <th>Size</th>
                <th>Màu sắc</th>
                <th>Tồn kho</th>
                <th>Hành động</th>
            </tr>
            <?php if (count($list_dacdiem_sp) > 0) {
                foreach ($list_dacdiem_sp as $v) { ?>
                <tr>
                    <td><?php echo $v['ma_dacdiem']; ?></td>
                    <td><?php echo $v['size']; ?></td>
                    <td><?php echo $v['loai_mau']; ?></td>
                    <td><?php echo $v['soluong_tonkho']; ?></td>
                    <td>
                        <a href="../../controler/ql_dacdiem_product.php?action=delete&ma_dacdiem=<?php echo $v['ma_dacdiem']; ?>&ma_sp=<?php echo $id_sp; ?>" 
                           class="btn btn-xoa"
                           onclick="return confirm('Xóa biến thể này?');">Xóa</a>
                    </td>
                </tr>
            <?php } 
            } else { echo "<tr><td colspan='4'>Sản phẩm này chưa có biến thể nào.</td></tr>"; } ?>
        </table>
    </div>
    <?php
    }
    ?>