<?php
include_once('./layout/header.php');
include_once('./layout/sidebar.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    if(isset($_COOKIE['cookieCustomer'])){
        $idCustomer = $_COOKIE['cookieCustomer'];
    }else{
        setcookie('cookieCustomer', time(), time() + 86400, '/');
        $idCustomer = $_COOKIE['cookieCustomer'];
    }
} else {
    $idCustomer = $_SESSION['user']['id'];
}

if (isset($_POST['submit'])) {
    $idCustomer = $idCustomer;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $totalPriceCart = $totalPriceCart;
    $notifi = [];
    if (empty($name)) {
        $notifi['name'] = 'Trường này không được bỏ trống!';
    }
    if (validate_Email($email)) {
        $notifi['email'] = validate_Email($email);
    }
    if (validate_Phone($phone)) {
        $notifi['phone'] = validate_Phone($phone);
    }
    if (empty($address)) {
        $notifi['address'] = 'Trường này không được bỏ trống!';
    }
    if (empty($notifi)) {
        
        $sqlOrder = "INSERT INTO tbl_order (customer_id, name, email, phone, status, address, total_price)
                    VALUES ('$idCustomer', '$name', '$email', '$phone', 0, '$address', $totalPriceCart)";
        if ($idOrder = exeQuery($sqlOrder, 1)) {
            foreach($cart as $item){
                $idProduct = $item['id'];
                $quantity = $item['quantity'];
                $price = $item['price'];
                $sqlOrderDetail = "INSERT INTO tbl_order_detail (order_id, product_id, quantity, price) VALUES($idOrder, $idProduct, $quantity, $price)";
                exeQuery($sqlOrderDetail);
            }     
            unset($_SESSION['cart']);
            header("Location:/order.php?id=$idOrder");
            $notifi['notifi'] = 'Đặt hàng thành công!';
            $notifi['status'] = 'susscess-data';   
        } else {
            $notifi['notifi'] = 'Đặt hàng thất bại!';
            $notifi['status'] = 'errors-data';
        }
    }
}

?>
<div class="content">
    <div class="checkout">
        <div class="info-customer">
            <div class="title">
                <h3>Địa chỉ nhận hàng</h3>
                <?php if (!isset($_SESSION['user'])) : ?>
                    <span>
                        Bạn đã có tài khoản?
                        <a class="btn-login">
                            Đăng nhập
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </span>
                <?php endif; ?>
            </div>

            <form action="" class="form-customer" method="POST">
                <div class="input">
                    <label for="">Họ tên</label>
                    <input name="name" type="text" placeholder="Ví dụ: Nguyễn Văn A" value="<?= $_SESSION['user']['name'] ?>">
                    <?php if (isset($notifi['name'])) : ?>
                        <span class="errors">
                            <?= $notifi['name'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="input-email-phone">
                    <div class="input-email">
                        <label for="">Email</label>
                        <input name="email" type="text" placeholder="Ví dụ: nguyenvana@gmail.com" value="<?= $_SESSION['user']['email'] ?>">
                        <?php if (isset($notifi['email'])) : ?>
                            <span class="errors" style="color: red;">
                                <?= $notifi['email'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="input-phone">
                        <label for="">Phone</label>
                        <input name="phone" type="text" placeholder="Ví dụ: 0123456789" value="<?= $_SESSION['user']['phone'] ?>">
                        <?php if (isset($notifi['phone'])) : ?>
                            <span class="errors" style="color: red; display: block; width: 200%;">
                                <?= $notifi['phone'] ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="input">
                    <label for="">Địa chỉ nhận hàng</label>
                    <input name="address" type="text" placeholder="Ví dụ: Hà Nội, Việt Nam" value="<?= $_SESSION['user']['address'] ?>">
                    <?php if (isset($notifi['address'])) : ?>
                        <span class="errors">
                            <?= $notifi['address'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="action-form">
                    <a href="/cart.php">
                        <i class="fas fa-shopping-cart"></i>
                        Giỏ hàng
                    </a>
                    <div class="submit">
                        <?php if (isset($notifi['notifi'])) : ?>
                            <span class="<?= $notifi['status'] ?>">
                                <?= $notifi['notifi'] ?>
                            </span>
                        <?php endif; ?>
                        <button type="submit" name="submit">Đặt hàng</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="info-products">
            <h3>Danh sách sản phẩm trong đơn hàng</h3>
            <?php foreach ($cart as $item) : ?>
                <div class="list-product-cart">
                    <img src="<?= link_Image . 'product/' . $item['image'] ?>" alt="">
                    <span class="quantity"><?= $item['quantity'] ?></span>
                    <span class="name"><?= $item['name'] ?></span>
                    <span class="price"><?= number_format($item['quantity'] * $item['price']) ?> VND</span>
                </div>
            <?php endforeach; ?>
            <div class="info-checkout">
                <span>Tổng: </span>
                <span><?= number_format($totalPriceCart) ?> VND</span>
            </div>
        </div>
    </div>
</div>
<?php
include_once('./layout/footer.php');
?>