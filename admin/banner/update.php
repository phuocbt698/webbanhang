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
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $notifi = [];
    if(!empty($_FILES['img_Banner']['name'])){
        $imgName = $_FILES['img_Banner']['name'];
        $imgType = str_replace("image/", '', $_FILES['img_Banner']['type']);
        $imgTmp = $_FILES['img_Banner']['tmp_name'];
        $imgNameNew = create_slug($imgName) . '.' .$imgType;
        $dirFile = foler_Image . 'banner/' . $imgNameNew;
        if (!getimagesize($_FILES['img_Banner']['tmp_name'])) {
            $notifi['image'] = "Trường này nhận dữ liệu dạng ảnh!";
        } 
    }
    
    if (validate_str($title)) {
        $notifi['title'] = validate_str($title);
    }
    if (validate_Date($time_start)) {
        $notifi['time_start'] = validate_Date($time_start);
    }
    if (validate_Date($time_end)) {
        $notifi['time_end'] = validate_Date($time_end);
    }
    if (empty(validate_Date($time_start)) && empty(validate_Date($time_start))) {
        if (strtotime($time_end) < strtotime($time_start)) {
            $notifi['time_end'] = "Thời gian kết thúc cần lớn hơn thời gian bắt đầu!";
        }
    }  
    if (!$notifi) {   
        if($imgNameNew){
            $move_Image = move_uploaded_file($imgTmp, $dirFile);
            unlink(foler_Image.'banner/'.$result['image']);
            $sqlUpdate = "UPDATE tbl_banner SET title = '$title', image = '$imgNameNew', time_start = '$time_start', time_end = '$time_end' WHERE id = $id";       
        }
        else{
            $sqlUpdate = "UPDATE tbl_banner SET title = '$title', time_start = '$time_start', time_end = '$time_end' WHERE id = $id";
        }
        if (exeQuery($sqlUpdate)) {
            $notifi['notifi'] = 'Dữ liệu được thêm thành công!';
            $notifi['status'] = 'susscess-data';
        } else {
            $notifi['notifi'] = 'Dữ liệu được thêm thất bại!';
            $notifi['status'] = 'errors-data';
        }
    }
}
?>
<div class="table-data">
    <div class="header-table">
        <h3>Chỉnh sửa banner</h3>
        <a href="<?= url_Admin ?>/banner" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách banner
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
            <div class="input-data">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="input-text" value="<?= (isset($title)) ? $title: $result['title'] ?>">
                <?php if (isset($notifi['title'])) : ?>
                    <span class="errors">
                        <?= $notifi['title'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="img_Banner">Image</label>
                <input type="file" name="img_Banner" id="img_Banner" class="input-file">
                <?php if (isset($notifi['image'])) : ?>
                    <span class="errors">
                        <?= $notifi['image'] ?>
                    </span>
                <?php endif; ?>
                <div class="preview">
                    <label for="">Ảnh cũ</label>
                    <img src="<?=($imgNameNew) ? public_Image. 'banner/' . $imgNameNew : public_Image. 'banner/' . $result['image']?>" alt="" class="imageOld">
                </div>
            </div>
            <div class="input-data">
                <label for="time_start">Time start</label>
                <input type="date" name="time_start" id="time_start" class="input-text" value="<?= (isset($time_start)) ? format_time($time_start, 'Y-m-d') : '' ?>">
                <?php if (isset($notifi['time_start'])) : ?>
                    <span class="errors">
                        <?= $notifi['time_start'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="time_end">Time end</label>
                <input type="date" name="time_end" id="time_end" class="input-text" value="<?= (isset($time_end)) ? format_time($time_end, 'Y-m-d') : '' ?>">
                <?php if (isset($notifi['time_end'])) : ?>
                    <span class="errors">
                        <?= $notifi['time_end'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <?php if (isset($notifi['notifi'])) : ?>
                <span class="<?= $notifi['status'] ?>">
                    <?= $notifi['notifi'] ?>
                </span>
            <?php endif; ?>
            <div class="submit-form">
                <button id="submit" type="submit" name="submit">Lưu lại</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once('../layout/footer.php');
?>