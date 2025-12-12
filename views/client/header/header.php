<?php
require_once __DIR__ . '/../../../autoload.php';
if (!isset($_SESSION)) session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="/views/client/css/style.css">
    <link rel="stylesheet" href="/views/client/css/header.css">
</head>
<body>
    <header>
            <div class="logo">
                <img src="/images/logo.png" alt="">
            </div>
            <div class="menu">
                <li><a href="/index.php">TRANG CHỦ</a></li>
                <li><a href="/views/client/gioithieu/gioithieu.php">GIỚI THIỆU</a></li>
                <?php
                        $category= new Category();
                        $list_ct = $category->getAll_dm();
                    ?>
                <li><p href="">DANH MỤC</p>
                    <ul class="sub_menu">
                        <?php
                            if(count($list_ct) > 0):
                                foreach($list_ct as $cat){
                        ?>
                            <li><a href="/views/client/cartegory/cartegory.php?method=show_danhmuc&ma_danhmuc=<?php echo $cat['ma_danhmuc']?>">Giày <?php echo $cat['ten_danhmuc']?> </a></li> 
                        <?php
                            }
                        else:
                        ?>
                         <p style="text-align: center; width: 100%;">Không có danh mục nào để hiển thị.</p>
                        <?php
                        endif; 
                        ?>
                    </ul>
                </li>
                <li><a href="">TIN TỨC</a></li>
                <li><a href="/views/client/lienhe/lienhe.php">LIÊN HỆ</a></li>
            
           
            </div>
            <div class="others">
                <li class="search">
                    <form action="/views/client/cartegory/cartegory.php" method="GET" style="display: flex; align-items: center;">
        
                <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" >
                    <button type="submit" style="border: none; background: none; cursor: pointer;">
                        <img src="/images/logo_search.png" alt="Search">

                    </button>       
                   </form>
                </li>
        <?php
            if (!isset($_SESSION)) session_start();
            if (!isset($_SESSION['admin_login']) && !isset($_SESSION['user_login'])){
                echo '<li><a href="/views/client/auth/login.html"><img src="/images/logo_user.png"></a></li>';
            }else if(isset($_SESSION['admin_login']) && !isset($_SESSION['user_login'])){
                echo '<li><a href="/views/admin/index.php"><img src="/images/logo_user.png"></a></li>';
            }else {
                echo '<li><a href="/views/client/auth/quanly_taikhoan.php"><img src="/images/logo_user.png"></a></li>';
            }
        ?>
                <li><a href="/views/client/cart/cart.php"><img src="/images/logo_giohang.png"></a></li>
            </div>
               
    </header>
    </body>
</html>
      