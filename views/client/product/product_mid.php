<?php
require_once 'autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartegory</title>
    <link rel="stylesheet" href="/views/client/css/header.css">
    <link rel="stylesheet" href="/views/client/css/cartegory.css">

</head>
<body>
    <div class="box_mid ">
        <?php
            $product = new Giay();
            $list_product = $product->getAll_limit8();
        ?>
        <div class="cartegory_right_content " >
            <?php
                if (count($list_product) > 0):
                    foreach ($list_product as $sp){
            ?>
                        <div class="cartegory_right_content_item">
                            <a href="/views/client/product/product.php?id=<?php echo $sp['ma_sp']; ?>">
                                <div class="product_img">
                                <img src="/images/<?php echo $sp['link_hinhanh']; ?>" alt="">
                                </div>
                                <h1><?php echo $sp['tensp']; ?></h1>
                                <p><?php echo number_format($sp['giasp']); ?><sup>đ</sup></p>
                            </a>
                        </div>
            <?php
                    }
                else:
            ?>
                    <p style="text-align: center; width: 100%;">Không có sản phẩm nào để hiển thị.</p>
            <?php
            endif; 
            ?>
        </div> 

    </div> 


</body>