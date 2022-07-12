<?php
include_once('./layout/header.php');
include_once('./layout/sidebar.php');
?>

<?php
if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
} else {
    $id = $_COOKIE['cookieCustomer'];
}
$sqlOrder = "SELECT * FROM tbl_order WHERE customer_id = $id";
$resultOrder = getData($sqlOrder);
?>

<div class="content">
    <div class="cart">
        <div class="header-cart">
            <h2>Đơn hàng của bạn</h2>
            <span>Đơn hàng của bạn sẽ xuất hiện ở đây!</span>
        </div>
        <div class="line"></div>
        <div class="content-order">
            <?php if(empty($resultOrder)) : ?>
                <div style="margin-top: 5%;margin-bottom: 13%;">
                    <span>Bạn chưa có đơn hàng nào! <a href="/" style="text-decoration: revert;">Hãy tiếp tục mua sắm!</a></span>
                </div>
            <?php else:?>
                <div class="list-order">
                <?php foreach ($resultOrder as $order) : ?>
                    <?php
                    $order_id = $order['id'];
                    $sqlOrderDetail = "SELECT * FROM tbl_order_detail WHERE order_id = $order_id";
                    $resultOrderDetail = getData($sqlOrderDetail);
                    ?>
                    <div class="order">
                        <div class="date-order">
                            <div class="order_title">
                                <span>Đơn hàng ngày:</span>
                                <span>
                                    <?= format_time($order['created_at']) ?>
                                </span>
                            </div>
                            <div class="status_order">
                                <span>Trạng thái:</span>
                                <span>
                                    <?php
                                    $status = $order['status'];
                                    switch ($status) {
                                        case 0:
                                            echo 'Đang chờ';
                                            break;
                                        case 1:
                                            echo 'Đang giao hàng';
                                            break;
                                        case 2:
                                            echo 'Hoàn thành';
                                            break;
                                        case 3:
                                            echo 'Đơn hàng bị hủy';
                                            break;
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="total_price_date">
                                <span>Tổng tiền: </span>
                                <span>
                                    <?= number_format($order['total_price']) ?> VND
                                </span>
                            </div>
                        </div>
                        <?php foreach ($resultOrderDetail as $orderDetail) : ?>
                            <?php
                            $id_Product = $orderDetail['product_id'];
                            $sqlProduct = "SELECT * FROM tbl_product WHERE id = $id_Product";
                            $resultProduct = getData($sqlProduct, 1);
                            ?>
                                <div class="order-info-product">
                                    <img src="<?=link_Image . 'product/' . $resultProduct['image']?>" alt="">
                                    <div class="para-product">
                                        <div class="product-name">
                                            <span>
                                                <?= ucfirst($resultProduct['name']) ?>
                                            </span>
                                            <div class="price_order">
                                                <span>
                                                <?= number_format($resultProduct['price'])?> VND
                                                </span>
                                            <div class="quantity_oder">
                                                <span>Số lượng:</span>
                                                <span>
                                                    <?=$orderDetail['quantity']?>
                                                </span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="total-price">
                                            <span>
                                                <?= number_format($orderDetail['price'] * $orderDetail['quantity']) ?> VND
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php
include_once('./layout/footer.php');
?>