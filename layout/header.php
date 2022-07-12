<?php ob_start(); ?>
<?php
    session_start();
?>
<?php
    define('url_Main', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']) ;
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']);
    define('public_Image', doc_Root . '/public/image/');
    define('link_Image', url_Main . '/public/image/');
?>

<?php
    include_once (doc_Root. '/database/db_helper.php');
    include_once (doc_Root. '/database/validate.php');
    include_once (doc_Root. '/database/convert.php');
?>

<?php
    if( isset($_GET['action']) && $_GET['action'] == 'logout'){
        unset($_SESSION['user']);
        header("Location:/");  
    }
?>

<?php
    $sqlConfig = "SELECT * FROM tbl_config";
    $resultConfig = getData($sqlConfig, 1);
    $sqlCategory = "SELECT * FROM tbl_category";
    $resultCategory = getData($sqlCategory);
?>

<?php

    
    if(isset($_POST['login'])){
        $notifiLogin = [];
        $email = $_POST['email_login'];
        $password = $_POST['password_login'];
        $file = $_SERVER['PHP_SELF'];
        if (validate_Email($email)) {
            $notifiLogin['email'] = validate_Email($email);
        }
        if(validate_Str($password)) {
            $notifiLogin['password'] = validate_Str($password);
        }else{
            $password = md5($password);
        }
        if(empty($notifiLogin)){
            $sqlLogin = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
            $resultLogin = getData($sqlLogin, 1);
            if(!empty($resultLogin)){
                $_SESSION['user']['name'] = $resultLogin['name'];
                $_SESSION['user']['id'] = $resultLogin['id'];
                $_SESSION['user']['email'] = $resultLogin['email'];
                $_SESSION['user']['phone'] = $resultLogin['phone'];
                $_SESSION['user']['address'] = $resultLogin['address'];
                $_SESSION['user']['image'] = $resultLogin['image'];     
                if($file == '/checkout.php'){
                    header("Location:/checkout.php");
                }else{
                    header("Location:/");
                }
            }else{
                $notifiLogin['login'] = "Tài khoản hoặc mật khẩu không chính xác!";
            }
        }

    }
?>

<?php
    if(isset($_POST['register'])){
        $notifiResgister = [];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];
        $imgName = $_FILES['imgUser']['name'];
        $imgType = str_replace("image/", '', $_FILES['imgUser']['type']);
        $imgTmp = $_FILES['imgUser']['tmp_name'];
        $imgNameNew = create_slug($imgName) . '.' .$imgType;
        $dirFile = public_Image . 'user/' . $imgNameNew;
    
        if (empty($name)) {
            $notifiResgister['name'] = 'Trường này không được bỏ trống!';
        }
        if (validate_Email($email)) {
            $notifiResgister['email'] = validate_Email($email);
        }else{
            $result = 'SELECT * FROM tbl_customer WHERE  BINARY email = ' . "'$email'";
            if (getData($result)) {
                $notifiResgister['email'] = 'Email đã tồn tại!';
            }
        }
        if(validate_Str($password)) {
            $notifiResgister['password'] = validate_Str($password);
        }else{
            $password = md5($password);
        }
        if(validate_Phone($phone)){
            $notifiResgister['phone'] = validate_Phone($phone);
        }else{
            $result = 'SELECT * FROM tbl_customer WHERE  BINARY phone = ' . "'$phone'";
            if (getData($result)) {
                $notifiResgister['phone'] = 'Số điện thoại đã tồn tại!';
            }
        }
        if(validate_Date($birthday)){
            $notifiResgister['birthday'] = validate_Date($birthday);
        }
        if(empty($address)){
            $notifiResgister['address'] = 'Trường này không được bỏ trống!';
        }
    
        if (!empty($_FILES['imgUser']['name'])) {
            if (!getimagesize($_FILES['imgUser']['tmp_name'])) {
                $notifiResgister['imgUser'] = "Trường này nhận dữ liệu dạng ảnh!";
            } else {
                $result = 'SELECT * FROM tbl_customer WHERE  BINARY image = ' . "'$imgNameNew'";
                if (getData($result)) {
                    $notifiResgister['imgUser'] = 'Ảnh đã tồn tại hoặc tên ảnh bị trùng (có thể đổi name khác)!';
                }
            }
        } else {
            $notifiResgister['imgUser'] = "Trường này không được bỏ trống!";
        }

        if(empty($notifiResgister)){
            $sql = "INSERT INTO tbl_customer(name, email, password, phone, image, birthday, address) 
                VALUES ('$name', '$email', '$password', '$phone', '$imgNameNew', '$birthday', '$address')";
            $move_Image = move_uploaded_file($imgTmp, $dirFile);
            if (exeQuery($sql) && $move_Image) {
                $sqlUser = "SELECT * FROM tbl_customer WHERE email LIKE '%$email%' ";
                $resultUser = getData($sqlUser, 1);
                $_SESSION['user']['name'] = $resultUser['name'];
                $_SESSION['user']['id'] = $resultUser['id'];
                $_SESSION['user']['email'] = $resultUser['email'];
                $_SESSION['user']['phone'] = $resultUser['phone'];
                $_SESSION['user']['address'] = $resultUser['address'];
                $_SESSION['user']['image'] = $resultUser['image']; 
                header("Location:/");               
            } 
        }
    }
?>
<?php
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="<?=url_Main?>/public/image/logo/logo-web.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=url_Main?>/public/customer/css/cart.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/customer/css/checkout.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/customer/css/main.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/customer/css/product_detail.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/customer/css/order.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/customer/css/profile.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/share/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="<?=url_Main?>/public/share/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="<?=url_Main?>">
                    <img src="<?=url_Main?>/public/image/logo/logo-web.png" alt="">
                </a>
            </div>
            <div class="key-search">
                <form action="" class="form-search">
                    <input class="data-search" type="search" name="text_search" id="" placeholder="Tìm kiếm">
                    <button class="btn-submit" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="contact contact-phone">
                <i class="fas fa-phone-alt"></i>
                <div class="content">
                    <span>Hotline</span>
                    <a href="tel:<?=$resultConfig['phone']?>">
                        <span><?=$resultConfig['phone']?></span>
                    </a>
                </div>
            </div>
            <div class="contact login-user">
                <i class="far fa-user-circle"></i>
                <div class="content" <?=isset($_SESSION['user']) ? 'id="user_login"' : ''?>>
                    <span><?=isset($_SESSION['user']) ? 'Xin chào' : 'Tài khoản'?></span>
                    <div class="btn-login" >
                        <span><?=isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Đăng nhập'?></span>
                        
                    </div>
                    <?php if(isset($_SESSION['user'])): ?>
                        <div class="action_user">
                            <div class="modal_user">
                                <div class="infor">
                                    <img src=" <?= link_Image . 'user/' . (isset($_SESSION['user']) ? $_SESSION['user']['image'] : '')?>" alt="">
                                    <span><?= (isset($_SESSION['user']) ? $_SESSION['user']['name'] : '') ?></span>
                                </div>
                                <div class="action">
                                    <a href="/profile.php?id=<?=(isset($_SESSION['user']) ? $_SESSION['user']['id'] : '')?>">Profile</a>
                                    <a href="/?action=logout">Logout</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-login"
                    <?= (!empty($notifiLogin) || !empty($notifiResgister)) ? 'style="display:block"' : ''?>
                >
                    <div class="content-modal">
                        <div class="header-modal">
                            <h3 class="btn-login h3-active"
                                <?= (!empty($notifiLogin) && empty($notifiResgister)) ? 'style="color: blue; border-bottom: 2px solid ghostwhite;"' : 'style="color: black; border-bottom: 0px;"' ?>
                            >Đăng nhập</h3>
                            <h3 class="btn-register"
                            <?= (empty($notifiLogin) && !empty($notifiResgister)) ? 'style="color: blue; border-bottom: 2px solid ghostwhite;"' : 'style="color: black; border-bottom: 0px;"' ?>
                            >Đăng ký</h3>
                        </div>
                        <div class="form">
                            <form action="" class="form-login" method="POST"
                            <?= (!empty($notifiLogin) && empty($notifiResgister)) ? 'style="display:block"' : 'style="display:none"' ?>
                            >
                                <div class="input">
                                    <label for="email_login">Email:</label>
                                    <input id="email_login" type="text" name="email_login" placeholder="Email" value="<?=(isset($email_login) ? $email_login : '')?>">
                                    <?php if (isset($notifiLogin['email'])) : ?>
                                        <span class="errors">
                                            <?= $notifiLogin['email'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="input">
                                    <label for="password_login">Password:</label>
                                    <input autocomplete="off" id="password_login" type="password" name="password_login" placeholder="Password">
                                    <?php if (isset($notifiLogin['password'])) : ?>
                                        <span class="errors">
                                            <?= $notifiLogin['password'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="forgot-password">
                                    <a href="">Quên mật khẩu?</a>
                                </div>
                                <?php if (isset($notifiLogin['login'])) : ?>
                                        <span class="errors">
                                            <?= $notifiLogin['login'] ?>
                                        </span>
                                    <?php endif; ?>
                                <div class="btn-submit">
                                    <button type="submit" name="login">Đăng nhập</button>
                                </div>
                            </form>

                            <form action="" class="form-register" method="POST" enctype="multipart/form-data"
                                <?= (empty($notifiLogin) && !empty($notifiResgister)) ? 'style="display:block"' : 'style="display:none"' ?>
                            >
                                <div class="input">
                                    <label for="name">Họ và tên:</label>
                                    <input type="text" name="name" id="name" placeholder="Họ và tên" value="<?=(!empty($notifiResgister) ? $name : '')?>">
                                    <?php if (isset($notifiResgister['name'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['name'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="input">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" placeholder="Email" value="<?=(!empty($notifiResgister) ? $email : '')?>">
                                    <?php if (isset($notifiResgister['email'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['email'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="input">
                                    <label for="phone">Phone:</label>
                                    <input type="text" name="phone" id="phone" placeholder="Number phone" value="<?=(!empty($notifiResgister) ? $phone : '')?>"> 
                                    <?php if (isset($notifiResgister['phone'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['phone'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="input">
                                    <label for="">Password:</label>
                                    <input autocomplete="off" type="password" name="password" id="password" placeholder="Password">
                                    <?php if (isset($notifiResgister['password'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['password'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="input">
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" id="address" placeholder="Địa chỉ" value="<?=(!empty($notifiResgister) ? $address : '')?>">
                                    <?php if (isset($notifiResgister['address'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['address'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="input">
                                    <label for="imgUser">Image</label>
                                    <input accept="image/*" type="file" id="imgUser" name="imgUser">
                                    <?php if (isset($notifiResgister['imgUser'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['imgUser'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="preview">

                                </div>
                                <div class="input">
                                    <label for="birthday">Ngày sinh:</label>
                                    <input type="date" name="birthday" id="birthday" value="<?=(!empty($notifiResgister) ? $birthday : '')?>">
                                    <?php if (isset($notifiResgister['birthday'])) : ?>
                                        <span class="errors">
                                            <?= $notifiResgister['birthday'] ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="btn-submit">
                                    <button type="submit" name="register">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-small">
                <div class="content-cart-small">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="total"><?= count($cart) ?></span>
                    <div class="info-cart-small dropdown_menu">
                        <div class="product-in-cart-small">
                            <?php foreach($cart as $key => $item): ?>
                                <?php $totalPriceCart += $item['quantity'] * $item['price']?>
                                <?php $totalProduct += $key?>
                                <div class="product">
                                <div class="img-product">
                                    <img src="<?= link_Image . 'product/' . $item['image'] ?>" alt="">
                                </div>
                                <div class="info-product">
                                    <div class="name-product">
                                        <span>
                                            <?= $item['name'] ?>
                                        </span>
                                        <a href="/process_cart.php?id=<?=$item['id']?>&action=del">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    <div class="quantity-price">
                                        <div class="quantity">                     
                                            <span>
                                            <?= $item['quantity'] ?>
                                            </span>
                                        </div>
                                        <div class="price">
                                            <span>
                                                <?= number_format($item['quantity'] * $item['price']) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <div class="total-price-cart-small">
                            <span>Tổng:</span>
                            <span>
                                <?= number_format($totalPriceCart)?> VND
                            </span>
                        </div>
                        <div class="payment">
                            <a href="/order.php">Đơn hàng</a>
                            <a href="/cart.php">Giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <span class="title">Giỏ hàng</span>
            </div>
        </div>