<?php
    session_start();
    define('url_Admin', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/admin') ;
    define('url_Main', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']) ;
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']) ;
?>

<?php
    include_once doc_Root . "/database/db_helper.php";
    include_once doc_Root . "/database/validate.php";  
?>

<?php  
    if(isset($_POST['submit']))
    {   
        $errors = [];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_pass'];
        if(validate_Email($user_email)){
            $errors['email'] = validate_Email($user_email);
        }
        if(validate_Str($user_password)){
            $errors['password'] = validate_Str($user_password);
        }
        if(!$errors){
            $user_password = md5($user_password);
            $sql = 'SELECT tbl_admin.*, tbl_role.name AS role_name FROM tbl_admin 
                 LEFT JOIN tbl_role ON tbl_admin.role_id = tbl_role.id 
                 WHERE email = ' . " '$user_email '" . ' AND password  = ' . " '$user_password'";
            $result = getData($sql, 1);
            if(!empty($result)){
                $_SESSION['admin'];
                $_SESSION['admin']['id'] = $result['id'];
                $_SESSION['admin']['name'] = $result['name'];
                $_SESSION['admin']['email'] = $result['email'];
                $_SESSION['admin']['image'] = $result['image'];
                $_SESSION['admin']['role_id'] = $result['role_id'];
                $_SESSION['admin']['birthday'] = $result['birthday'];
                $_SESSION['admin']['address'] = $result['address'];
                header("Location:" . url_Admin);
            }
            $errors['login'] = "Tài khoản hoặc mật khẩu không chính xác!";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="<?=url_Main?>/public/admin/css/login.css">
</head>
<body>
    <div class="container">
        <div class="screen">           
            <div class="screen__content">
                <div class="header-screen">
                    <h3>Đăng nhập hệ thống</h3>
                    <img src="<?=url_Main?>/public/image/logo/logo-web.png" alt="">
                </div>
                <form class="login" method="POST" action="">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input name="user_email" type="text" class="login__input" placeholder="User name / Email">
                        <?php if(isset($errors['email'])):?>
                            <span class="error">
                                <?=$errors['email']?>
                            </span>
                        <?php endif;?>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input name="user_pass" type="password" class="login__input" placeholder="Password">
                        <?php if(isset($errors['password'])):?>
                            <span class="error">
                                <?=$errors['password']?>
                            </span>
                        <?php endif;?>
                    </div>
                    <?php if(isset($errors['login'])):?>
                            <span class="error">
                                <?=$errors['login']?>
                            </span>
                        <?php endif;?>
                    <button class="button login__submit" type="submit" name="submit">
                        <span class="button__text">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>				
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>		
        </div>
    </div>
</body>
</html>