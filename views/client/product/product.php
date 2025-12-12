<?php
require_once __DIR__ . '/../../../autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCT</title>
    <link rel="stylesheet" href="/views/client/css/style.css">
    <link rel="stylesheet" href="/views/client/css/product.css">

</head>
<body>
    <?php include_once '../header/header.php'; ?>
    <?php
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $data = new Sach();
            $product_detail = $data->getByid($id);
            $product_info = $data->getAll_dacdiem_byid($id);
            
            if(count($product_detail) > 0){
                $product = $product_detail[0];
                $data = new Category();
                $category_detail = $data->getByid_dm($product['ma_danhmuc']);
                $c = $category_detail[0];
            }else
                $product=null;
        }else
        $product=null;
    ?>
    <div class="product">
        <div class="container">
            <div class="product_top row">
                <p><a href="../../../index.php">Trang chủ</a></p> <span>&#10230;</span>  <p><a href="cartegory.php?ma_danhmuc=<?php echo $ma_danhmuc ?>"><?php echo $c['ten_danhmuc']; ?></a></p><span>&#10230;</span> <p><?php echo $product['tensp'] ?></p>
            </div>
            <div class="product_content row">
                <div class="product_content_left row">
                    <div class="product_content_left_big_img">
                        <img src="/images/<?php echo $product['link_hinhanh'] ?>" alt="">
                    </div>
                    <div class="product_content_left_small_img">
                        <img src="/images/sach_1.png" alt="">
                        <img src="/images/sach_2.png" alt="">
                        <img src="/images/sach_3.png" alt="">
                        <img src="/images/sach_4.png" alt="">
                    </div>
                </div>
                
                <form class="product_content_right" method="POST" action="../../../../controler/giohangcontroler.php">    
                <div class="product_content_right_product_name">
                        <h1><?php echo $product['tensp'] ?></h1>
                        <P>Mã sản phẩm: <?php echo $product['ma_sp'] ?></P>
                        <input type="hidden" name="ma_sp" value="<?php echo $product['ma_sp'] ?>">
                    </div>
                    <div class="product_content_right_product_price">
                        <p>Giá: <?php echo number_format($product['giasp']); ?><sup>đ</sup></p>
                    </div>
                    <div class="product_content_right_product_color">
                        <p><span style="font-weight:bold;">Phiên bản</span>: <?php
                            foreach($product_info as $item){
                                
                           echo '<span><input type="radio" name="color" value="' .$item['phien_ban']  .'" checked>'. $item['phien_ban'] .' &nbsp;</span>';
                            
                            }
                            ?><span style="color:red;">*</span></p>
                    </div>
                    <div class="product_content_right_product_size">
                        <p style="font-weight:bold;">Chất liệu:</p>
                        <div class="size">
                            <?php
                            foreach($product_info as $item){
                                
                           echo '<span><input type="radio" name="chat_lieu" value="' .$item['chat_lieu']  .'" checked>'. $item['chat_lieu'] .'</span>';
                            
                            }
                            ?>
                        </div>
                        <p style="color:red;">Vui lòng chọn chất liệu</p>
                    </div>
                    <div class="quantity">
                        <p style="font-weight:bold;">Số lượng:</p>
                        <input type="number" min="0" value="1" name="soluong">
                        
                    </div>
                    
                    <div class="product_content_right_product_button">
                        <button type="submit"><img src="/images/logo_tuigiohang.png" alt=""> THÊM GIỎ HÀNG</button>
                        
                    </div>
                    <!-- <div class="product_content_right_bottom">
                        <div class="product_content_right_bottom_top">

                        </div>
                    </div> -->
                </div>
            </form>
            
        </div>
    </div>
   <?php include_once '../footer/footer.php'; ?>
    
</body>
</html>