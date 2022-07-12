<?php ob_start(); ?>
<?php
    session_start();
?>
<?php
    define('url_Admin', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/admin') ;
    define('url_Main', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']) ;
    define('folder_Name', array_diff(explode('/', $_SERVER['REQUEST_URI']), array('',''))['2']);
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']) ;
    define('public_Image', url_Main . '/public/image/');
    define('foler_Image', doc_Root . '/public/image/');
?>
<?php
    include_once doc_Root . '/database/db_helper.php';
    include_once doc_Root . '/database/validate.php';
    include_once doc_Root . '/database/convert.php';
?>
<?php
    if(empty($_SESSION['admin'])){
        header("Location:" . url_Admin . '/login.php');
    }
?>
<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        session_destroy();
        header("Location:" . url_Admin . '/login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | <?=(!folder_Name) ? 'Dashboard' : ucfirst(folder_Name)?></title>
    <link rel="shortcut icon" href="<?=url_Main?>/public/image/logo/logo-web.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=url_Main?>/public/share/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="<?=url_Main?>/public/share/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?=url_Main?>/public/admin/css/main.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/admin/css/create.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/admin/css/detail.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/admin/css/dashboard.css">
    <link rel="stylesheet" href="<?=url_Main?>/public/admin/css/order_detail.css">
    <script src = "<?=url_Main?>/public/admin/js/highcharts.js"></script>
    <script src="<?=url_Main?>/public/share/ckeditor_4.19.0_full/ckeditor/ckeditor.js"></script>
    <script src="<?=url_Main?>/public/admin/js/preview-img.js" defer="defer"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="">
                    <img src="<?=url_Main?>/public/image/logo/logo-web.png" alt="">
                </a>
            </div>
            <div class="title-header">
                <h2>Quản lý hệ thống</h2>
            </div>
            <div class="user-info">
                <div class="title-user">
                    <span>Xin chào!<?=$_SESSION['admin']['name']?></span>
                </div>
                <div class="img-user">
                    <img src="<?=public_Image . 'admin/'?><?=(isset($_SESSION['admin']['image'])) ? $_SESSION['admin']['image'] : 'user-default.png'?>" alt="" style="border-radius: 50%;">
                    <div class="modal-user">
                        <div class="info-detail">
                            <div class="header-modal">
                            <img src="<?=public_Image . 'admin/'?><?=(isset($_SESSION['admin']['image'])) ? $_SESSION['admin']['image'] : 'user-default.png'?>" alt="" style="border-radius: 50%;">
                                <div class="role-name">
                                    <?php if($_SESSION['admin']['name']):?>
                                        <span>
                                            <?=$_SESSION['admin']['name']?>
                                        </span>
                                    <?php endif;?>
                                    <?php if($_SESSION['admin']['birthday']):?>
                                        <span>
                                        <?=format_time($_SESSION['admin']['birthday'])?>
                                    </span>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="footer-modal">
                                <a href="<?=url_Admin?>/user-admin/detail.php?id=<?=$_SESSION['admin']['id']?> "class="button">
                                    Profile
                                </a>   
                                <a href="<?=url_Admin?>?action=logout"class="button">
                                    Logout
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">