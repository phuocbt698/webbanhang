<?php
    include_once('../layout/header.php');
    include_once('../layout/sidebar.php');
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_banner WHERE id = $id";
        $result = getData($sql, 1);
        if(empty($result)){
            header("Location:" . url_Admin .'/banner');
        }
    }
?>

<div class="detail">
                    <div class="header-detail">
                        <h3>Thông tin chi tiết</h3>
                        <a href="<?=url_Admin?>/banner">Danh sách</a>
                    </div>
                    <div class="content-detail">
                        <div class="img">
                            <img src="<?=public_Image?>/banner/<?=$result['image']?>" alt="">
                        </div>
                        <div class="content">
                            <div class="sub-content">
                                <h3>Tiêu đề:</h3>
                                <span><?=$result['title']?></span>
                            </div>
                            <div class="sub-content">
                                <h3>Time_start:</h3>
                                <span><?=date('d/m/Y', strtotime($result['time_start']))?></span>
                            </div>
                            <div class="sub-content">
                                <h3>Time_end:</h3>
                                <span><?=date('d/m/Y', strtotime($result['time_end']))?></span>
                            </div>
                        </div>
                    </div>
                </div>
<?php
    include_once('../layout/footer.php');
?>