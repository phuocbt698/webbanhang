<?php ob_start(); ?>
<?php
    session_start();
    // session_destroy();
    // die();
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']);
    include_once (doc_Root. '/database/db_helper.php');
?>
<?php
    $quantity = 1;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    if(isset($_GET['fromPage'])){
        $fromPage = $_GET['fromPage'];
    }
    if(isset($_POST['quantity'])){
        $quantity = $_POST['quantity'];
    }
    if(isset($_POST['fromPage'])){
        $fromPage = $_POST['fromPage'];
    }
    if(isset($_POST['id_product'])){
        $product_id = $_POST['id_product'];
    }
    if(isset($_GET['id'])){
        $product_id = $_GET['id'];
    }
    $sqlProduct = "SELECT * FROM tbl_product WHERE id = $product_id";
    $product = getData($sqlProduct, 1);
    $itemCart = [
        'id'=> $product['id'],
        'name'=> $product['name'],
        'image'=> $product['image'],
        'price'=> $product['price'],
        'quantity'=> $quantity
    ];
    
    if(isset($_SESSION['cart'][$product_id])){
        if($action == 'plus' || empty($action)){
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        }elseif($action == 'minus'){
            if($_SESSION['cart'][$product_id]['quantity'] <= 1){
                unset($_SESSION['cart'][$product_id]);
            }else{
                $_SESSION['cart'][$product_id]['quantity'] -= $quantity;
            }
        }elseif($action == 'del'){
            unset($_SESSION['cart'][$product_id]);
        }
    }else{
        $_SESSION['cart'][$product_id] = $itemCart;
    }

    if($fromPage == 'productDetail'){
        header("Location:/product.php?id=$product_id");
    }
    elseif($fromPage == 'cart'){
        header("Location:/cart.php");
    }else{
        header("Location:/");
    }
    
?>