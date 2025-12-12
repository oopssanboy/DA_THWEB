<?php
require_once 'autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DA_TTCN_WEBSITE_BANGIAY</title>
    

    
</head>
<body>
    <?php
        if (!isset($_SESSION)) session_start();
        
    ?>
    <?php include_once 'views/client/header/header.php'; ?>
    
    <!-- <div class="banner_km">
           <img src="public/frontend/images/banner_km.png" alt="">
    </div> -->
     <?php include_once 'views/client/slide/slide.php'; ?>    
    <br>
    <h1 style="text-align: center;">SHOPPING CÙNG CHAPTER ONE - THE BEGINNING</h1>
    <div class="banner_spm">
        
        <img src="images/banner_sanphammoi.png" alt="">
    </div>
    
    <?php include_once 'views/client/product/product_mid.php'; ?>
    <?php include_once 'views/client/footer/footer.php'; ?>
    
</body>
</html>
