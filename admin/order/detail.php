<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT tbl_order.*, tbl_admin.name as admin_name FROM tbl_order
            LEFT JOIN tbl_admin ON tbl_order.admin_id = tbl_admin.id WHERE tbl_order.id = $id";
    $result = getData($sql, 1);
    $order_id = $result['id'];
    $sqlOrder = "SELECT * FROM tbl_order_detail WHERE order_id = $order_id";
    $resultOrder = getData($sqlOrder);
    if (empty($result)) {
        header("Location:" . url_Admin . '/order');
    }
}
?>

<div class="detail">
    <div class="header-detail">
        <h3>Thông tin chi tiết</h3>
        <a href="<?= url_Admin ?>/order">Danh sách</a>
    </div>
    <div class="content-order">
        <div class="order">
            <h2>Thông tin khách hàng</h2>
            <div class="info_order">
                <span>Admin: </span>
                <span><?= (empty($result['admin_name'])) ? '?' : $result['admin_name'] ?></span>
            </div>
            <div class="info_order">
                <span>Customer: </span>
                <span><?= $result['name'] ?></span>
            </div>
            <div class="info_order">
                <span>Email: </span>
                <span><?= $result['email'] ?></span>
            </div>
            <div class="info_order">
                <span>Phone: </span>
                <span><?= $result['phone'] ?></span>
            </div>
            <div class="info_order">
                <span>Status: </span>
                <span>
                <?php
                                $status = $result['status'];
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
            <div class="info_order">
                <span>Total Price: </span>
                <span><?= number_format($result['total_price']) ?> VND</span>
            </div>
            <div class="info_order">
                <span>Created_at: </span>
                <span><?= format_time($result['created_at']) ?></span>
            </div>
        </div>
        <div class="order_detail">
            <h2>Thông tin sản phẩm</h2>
            <?php foreach($resultOrder as $order) : ?>
                <?php
                    $product_id = $order['product_id'];
                    $sqlProduct = "SELECT * FROM tbl_product WHERE id = $product_id";
                    $resultProduct = getData($sqlProduct, 1);
                ?>
            <div class="product_order">
                <img src="<?= public_Image . 'product/' . $resultProduct['image']?>" alt="">
                <div class="product_infor">
                    <span><?= $resultProduct['name'] ?></span>
                    <span><?= number_format($resultProduct['price']) ?> VND</span>
                </div>
                <div class="product_quantity">
                    <span><?= $order['quantity'] ?></span>
                </div>
                <div class="total_price">
                    <span><?= number_format($order['price']) ?> VND</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
include_once('../layout/footer.php');
?>