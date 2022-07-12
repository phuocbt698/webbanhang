<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT tbl_product.*, tbl_category.name AS cate_name FROM tbl_product 
        LEFT JOIN tbl_category ON tbl_product.category_id = tbl_category.id  WHERE tbl_product.id = $id";
    $result = getData($sql, 1);
    if (empty($result)) {
        header("Location:" . url_Admin . '/product');
    }
}
?>

<div class="detail">
    <div class="header-detail">
        <h3>Thông tin chi tiết</h3>
        <a href="<?= url_Admin ?>/banner">Danh sách</a>
    </div>
    <div class="content-detail">
        <div class="img">
            <img src="<?= public_Image ?>/product/<?= $result['image'] ?>" alt="">
        </div>
        <div class="content">
            <div class="sub-content">
                <h3>Name:</h3>
                <span><?= $result['name'] ?></span>
            </div>
            <div class="sub-content">
                <h3>Category:</h3>
                <span><?= $result['cate_name'] ?></span>
            </div>
            <div class="sub-content">
                <h3>Price:</h3>
                <span><?= number_format($result['price']) ?></span>
            </div>
            <div class="sub-content">
                <h3>Quantity:</h3>
                <span><?= number_format($result['quantity']) ?></span>
            </div>
        </div>
    </div>
    <div class="description">
        <h3>Description:</h3>
        <div class="content-description">
            <?= $result['description'] ?>
        </div>
    </div>
</div>
<?php
include_once('../layout/footer.php');
?>