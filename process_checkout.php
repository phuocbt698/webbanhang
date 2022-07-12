<?php
    session_start();
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']);
    include_once (doc_Root. '/database/db_helper.php');
    include_once (doc_Root. '/database/validate.php');
?>

<?php
    if(!isset($_SESSION['user'])){
        setcookie('cookieCustomer', 'id-'.time(), '/');
        $idCustomer = $_COOKIE['cookieCustomer'];
    }else{
        $idCustomer = $_SESSION['user']['id'];
    }
    
    if(isset($_POST['submit'])){
        var_dump($_POST);
        $idCustomer = $idCustomer;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $notifi = [];
        if(empty($name)){
            $notifi['name'] = 'Trường này không được bỏ trống!';
        }
        if(validate_Email($email)){
            $notifi['email'] = validate_Email($email);
        }
        if(validate_Phone($phone)){
            $notifi['phone'] = validate_Phone($phone);
        }
        if(empty($address)){
            $notifi['address'] = 'Trường này không được bỏ trống!';
        }
    }
    
?>