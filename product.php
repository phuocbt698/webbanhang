<?php
include_once('./layout/header.php');
include_once('./layout/sidebar.php');
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlProduct = "SELECT * FROM tbl_product WHERE id = $id";
    if (getData($sqlProduct, 1)) {
        $resultProduct = getData($sqlProduct, 1);
        $categoryId = $resultProduct['category_id'];
        $sqlProductRelated = "SELECT * FROM tbl_product WHERE id != $id AND category_id = $categoryId LIMIT 5";
        $resultProductRelated = getData($sqlProductRelated);
    } else {
        header('Location:index.php');
    }
} else {
    header('Location:index.php');
}
?>
<div class="content">
    <div class="product-detail">
        <div class="info-detail">
            <form action="./process_cart.php" method="POST">
                <div class="info-product">
                    <div class="img-product">
                        <img src="<?= link_Image . 'product/' . $resultProduct['image'] ?>" alt="">
                    </div>
                    <div class="info">
                        <h3 class="name"><?= $resultProduct['name'] ?></h3>
                        <div class="status">
                            <span>Tình trạng:</span>
                            <?= ($resultProduct['quantity'] > 0) ? "<b style='color:#0db70a;'>Còn hàng</b>" : "<b style='color:red;'>Hết hàng</b>" ?>
                        </div>
                        <div class="price">
                            <span style="font-size: 25px; color: red;">
                                <?= number_format($resultProduct['price']) ?> VND
                            </span>
                        </div>
                        <div class="quantity">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="100">
                        </div>
                        <div class="action">
                            
                            <input type="hidden"  name="id_product" value="<?=$resultProduct['id']?>">
                            <input type="hidden" name="fromPage" value="productDetail">
                            <button type="submit" style="cursor: pointer;" <?= ($resultProduct['quantity'] > 0) ? 'class="active" ' : 'class="disabled"' ?>>
                                <i class="fas fa-cart-plus"></i>
                                <span>Thêm giỏ hàng</span>   
                            </button>
                            <a <?= ($resultProduct['quantity'] > 0) ? 'href="./process_cart.php?id=' . $resultProduct['id'] . '" class="active" ' : 'class="disabled"' ?>>
                                <i class="fas fa-money-check-alt"></i>
                                <span>Mua ngay</span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="description">
                <div class="content">
                    <div class="title">
                        <h2>Mô tả</h2>
                    </div>
                    <div class="content-product">
                        <?= $resultProduct['description'] ?>
                    </div>
                    <div class="show-more">
                        <span class="more-text">
                            Xem thêm
                            <i class="fas fa-angle-down"></i>
                        </span>
                        <span class="less-text" style="display: none;">
                            Thu gọn
                            <i class="fas fa-angle-up"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-product">
            <h3>Sản phẩm liên quan</h3>
            <div class="list-product-related">
                <?php foreach ($resultProductRelated as $productRelated) : ?>
                    <div class="product-related">
                        <img src="<?= link_Image . 'product/' . $productRelated['image'] ?>" alt="">
                        <div class="info-product">
                            <a href="/product.php?id=<?= $productRelated['id'] ?>">
                                <span><?= ucfirst($productRelated['name']) ?></span>
                            </a>
                            <span><?= number_format($productRelated['price']) ?> VND</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once('./layout/footer.php');
?>