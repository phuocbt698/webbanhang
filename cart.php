<?php
include_once('./layout/header.php');
include_once('./layout/sidebar.php');
?>

<div class="content">
    <div class="cart">
        <div class="header-cart">
            <h2>Giỏ hàng của bạn</h2>
            <?= 
                (!empty($cart)) ? "<span>Có ". count($cart) . " loại sản phẩm trong giỏ hàng </span>" : "<span>Chưa có gì trong giỏ hàng hãy tiếp tục mua sắm @@</span>"
            ?>
        </div>
        <div class="line"></div>
        <div class="content-cart">
            <div class="list-product-cart">
                <?php foreach ($cart as $item) : ?>
                    <div class="info-product">
                        <img src="<?= link_Image . 'product/' . $item['image'] ?>" alt="">
                        <div class="para-product">
                            <div class="product-name">
                                <span>
                                    <?= $item['name'] ?>
                                </span>
                                <a href="/process_cart.php?id=<?=$item['id']?>&action=del&fromPage=cart">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            <div class="price-product">
                                <div class="price">
                                    <span>
                                    <?= number_format($item['price']) ?>
                                    </span>
                                    <div class="quantity">
                                        <a href="/process_cart.php?id=<?=$item['id']?>&action=minus&fromPage=cart">
                                            <i class="fas fa-minus-circle"></i>
                                        </a>
                                        <span>
                                        <?= $item['quantity'] ?>
                                        </span>
                                        <a href="/process_cart.php?id=<?=$item['id']?>&action=plus&fromPage=cart">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="total-price">
                                    <span>
                                        <?= number_format($item['price'] * $item['quantity']) ?> VND
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="total-bill">
                <h3>Thông tin đơn hàng</h3>
                <div class="price-bill">
                    <span>Tổng:</span>
                    <span>
                        <?= number_format($totalPriceCart) ?> VND
                    </span>
                </div>
                <div class="action-bill">
                    <a <?= (!empty($cart)) ? 'href="./checkout.php" class="active" ' : 'class="disabled"' ?>>Thanh toán</a>
                    <a href="/index.php">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('./layout/footer.php');
?>