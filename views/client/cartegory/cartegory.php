<?php
require_once __DIR__ . '/../../../autoload.php';
if (!isset($_SESSION))
    session_start();

$category_model = new Category();
$product_model = new Sach();
$brand_model = new NXB();

$ma_danhmuc = isset($_GET['ma_danhmuc']) ? $_GET['ma_danhmuc'] : '';
$phan_loai = isset($_GET['phan_loai']) ? $_GET['phan_loai'] : '';
$sap_xep = isset($_GET['sap_xep']) ? $_GET['sap_xep'] : '';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$brand_selected = isset($_GET['nxb']) ? $_GET['nxb'] : [];
$size = isset($_GET['size']) ? $_GET['size'] : '';
$mau_sac = isset($_GET['mau_sac']) ? $_GET['mau_sac'] : '';
$gia = isset($_GET['gia']) ? $_GET['gia'] : '';

$c = "Tất cả sản phẩm";
if ($ma_danhmuc != '') {
    $category_detail = $category_model->getByid_dm($ma_danhmuc);
    if (!empty($category_detail)) {
        $c = $category_detail[0]['ten_danhmuc'];
    }
}

if ($keyword != '' || $gia != '') {
    $c = "Kết quả tìm kiếm: '" . $keyword .  "'" ;
    $c = "Kết quả tìm kiếm: '" . $gia .  "'" ;
}

$list_brand = $brand_model->getAll();
$list_product = $product_model->loc_san_pham($ma_danhmuc, $phan_loai, $sap_xep, $brand_selected, $size, $mau_sac, $keyword, $gia);

// $list_product = $product_model->timkiem($keyword,$gia);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <link rel="stylesheet" href="/views/client/css/header.css">
    <link rel="stylesheet" href="/views/client/css/cartegory.css">
</head>

<body>
    <?php include_once '../header/header.php'; ?>

    <div class="cartegory">
        <div class="container">
            <div class="cartegory_top row">
                <p><a href="../../../index.php">Trang chủ</a></p>
                <span>&#10230;</span>
                <p><a href="cartegory.php?ma_danhmuc=<?php echo $ma_danhmuc ?>"><?php echo $c; ?></a></p>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="cartegory_left">
                    <form action="" method="GET" id="mainFilterForm">

                        <?php if ($ma_danhmuc != '') { ?>
                            <input type="hidden" name="ma_danhmuc" value="<?php echo $ma_danhmuc; ?>">
                        <?php } ?>

                        <input type="hidden" name="sap_xep" id="hiddenSort" value="<?php echo $sap_xep; ?>">
                        
                        <?php if ($keyword != '') { ?>
                            <input type="hidden" name="keyword" value="<?php echo $keyword; ?>">
                        <?php } ?>

                        <div class="filter-group">
                            <h3 class="filter-title">ĐỐI TƯỢNG</h3>
                            <ul class="filter-list">
                                <li>
                                    <label>
                                        <input type="radio" name="phan_loai" value="Tất cả" onchange="this.form.submit()"
                                        <?php if ($phan_loai == 'Tất cả') echo 'checked'; ?>> 
                                        Tất cả
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="phan_loai" value="Người lớn" onchange="this.form.submit()" 
                                        <?php if ($phan_loai == 'Người lớn') echo 'checked'; ?>> 
                                        Người lớn
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="phan_loai" value="Thanh niên" onchange="this.form.submit()"
                                        <?php if ($phan_loai == 'Thanh niên') echo 'checked'; ?>> 
                                        Thanh niên
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="phan_loai" value="Học sinh" onchange="this.form.submit()"
                                        <?php if ($phan_loai == 'Học sinh') echo 'checked'; ?>> 
                                        Học sinh
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="radio" name="phan_loai" value="Thiếu nhi" onchange="this.form.submit()"
                                        <?php if ($phan_loai == 'Thiếu nhi') echo 'checked'; ?>> 
                                        Thiếu nhi
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-group">
                            <h3 class="filter-title">NHÀ XUẤT BẢN</h3>
                            <ul class="filter-list scroll-box">
                                <?php if (!empty($list_brand)) { ?>
                                    <?php foreach ($list_brand as $br) { ?>
                                        <?php $checked = in_array($br['ma_nxb'], (array) $brand_selected) ? 'checked' : ''; ?>
                                        <li>
                                            <label>
                                                <input type="checkbox" name="brand[]" value="<?php echo $br['ma_nxb']; ?>"
                                                    onchange="this.form.submit()" <?php echo $checked; ?>>
                                                <?php echo $br['ten_nxb']; ?>
                                            </label>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="filter-group">
                            <h3 class="filter-title">SIZE GIÀY</h3>
                            <div class="size-grid">
                                <?php for ($i = 36; $i <= 44; $i++) { ?>
                                    <label class="size-item">
                                        <input type="radio" name="size" value="<?php echo $i; ?>"
                                            onchange="this.form.submit()" <?php if ($size == $i) echo 'checked'; ?>>
                                        <span><?php echo $i; ?></span>
                                    </label>
                                <?php } ?>
                                <label class="size-item" title="Bỏ chọn">
                                    <input type="radio" name="size" value="" onchange="this.form.submit()">
                                    <span style="color:red;">&#10005;</span>
                                </label>
                            </div>
                        </div>

                        <div class="filter-group">
                            <h3 class="filter-title">PHIÊN BẢN</h3>
                            <ul class="filter-list">
                                <?php
                                $colors = ['Tiếng việt', 'Tiếng anh', 'Bản đặc biệt', 'Tái bản 2024', 'Có chữ ký', 'Thường','Bản kỹ niệm'];
                                foreach ($colors as $col) {
                                ?>
                                    <li>
                                        <label>
                                            <input type="radio" name="mau_sac" value="<?php echo $col; ?>"
                                                onchange="this.form.submit()" <?php if ($mau_sac == $col) echo 'checked'; ?>>
                                            <?php echo $col; ?>
                                        </label>
                                    </li>
                                <?php } ?>
                                <li>
                                    <label style="color:#888; font-style: italic;">
                                        <input type="radio" name="mau_sac" value="" onchange="this.form.submit()"> 
                                        Bỏ chọn màu
                                    </label>
                                </li>
                            </ul>
                        </div>

                    </form>
                </div>

                <div class="cartegory_right">
                    <div class="row">
                        <div class="cartegory_right_top_item">
                            <p><?php echo $c; ?> Mới Về</p>
                        </div>
                        <div class="cartegory_right_top_item">
                            <select onchange="updateSortAndSubmit(this.value)">
                                <option value="">Sắp xếp mặc định</option>
                                <option value="gia_giam" <?php if ($sap_xep == 'gia_giam') echo 'selected'; ?>>Giá cao đến thấp</option>
                                <option value="gia_tang" <?php if ($sap_xep == 'gia_tang') echo 'selected'; ?>>Giá thấp đến cao</option>
                            </select>
                        </div>
                    </div>

                    <div class="cartegory_right_content">
                        <?php if (count($list_product) > 0) { ?>
                            <?php foreach ($list_product as $sp) { ?>
                                <div class="cartegory_right_content_item">
                                    <a href="/views/client/product/product.php?id=<?php echo $sp['ma_sp']; ?>">
                                        <img src="/images/<?php echo $sp['link_hinhanh']; ?>" alt="">
                                        <h1><?php echo $sp['tensp']; ?></h1>
                                        <p><?php echo number_format($sp['giasp']); ?><sup>đ</sup></p>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p style="text-align: center; width: 100%; margin-top: 50px;">Không có sản phẩm nào phù hợp tiêu chí lọc.</p>
                        <?php } ?>
                    </div>

                    
                </div>
            </div>
        </div>
    <div class="cartegory_right_bottom row">
                            <div class="cartegory_right_bottom_item">
                            <p>Hiễn thị 2 <span>|</span> 4 Sản phẩm </p>
                            </div>
                            <div class="cartegory_right_bottom_item">
                                <p><span>&#171;</span> 1 2 3 4 5 <span>&#187;</span> Trang cuối</p>
                            </div>
                    </div>
    </div>

    <?php include_once '../footer/footer.php'; ?>

    <script>
        function updateSortAndSubmit(sortValue) {
            // 1. Gán giá trị sắp xếp vào input ẩn bên trái
            document.getElementById('hiddenSort').value = sortValue;
            // 2. Tự động submit form bên trái
            document.getElementById('mainFilterForm').submit();
        }
    </script>
</body>

</html>