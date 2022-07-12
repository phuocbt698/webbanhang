<?php
    include_once('../layout/header.php');
    include_once('../layout/sidebar.php');
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT tbl_admin.*, tbl_role.name AS role_name FROM tbl_admin 
        LEFT JOIN tbl_role ON tbl_admin.role_id = tbl_role.id  WHERE tbl_admin.id = $id";
        $result = getData($sql, 1);
        if(empty($result)){
            header("Location:" . url_Admin .'/user-admin');
        }
    }
?>

<div class="detail">
                    <div class="header-detail">
                        <h3>Thông tin chi tiết</h3>
                        <a href="<?=url_Admin?>/user-admin">Danh sách</a>
                    </div>
                    <div class="content-detail">
                        <div class="img">
                            <img src="<?=public_Image?>/admin/<?=$result['image']?>" alt="" style="width: 60%;">
                        </div>
                        <div class="content">
                            <div class="sub-content">
                                <h3>Name:</h3>
                                <span><?=$result['name']?></span>
                            </div>
                            <div class="sub-content">
                                <h3>Email:</h3>
                                <span><?=$result['email']?></span>
                            </div>
                            <div class="sub-content">
                                <h3>Role:</h3>
                                <span><?=$result['role_name']?></span>
                            </div>
                            <div class="sub-content">
                                <h3>Birthday:</h3>
                                <span><?=format_time($result['birthday'])?></span>
                            </div>
                            <div class="sub-content">
                                <h3>Addresss:</h3>
                                <span><?=$result['address']?></span>
                            </div>
                        </div>
                    </div>
                </div>
<?php
    include_once('../layout/footer.php');
?>