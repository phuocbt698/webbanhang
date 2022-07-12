<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $imgName = $_FILES['img_Banner']['name'];
    $imgType = str_replace("image/", '', $_FILES['img_Banner']['type']);
    $imgTmp = $_FILES['img_Banner']['tmp_name'];
    $imgNameNew = create_slug($imgName) . '.' .$imgType;
    $dirFile = foler_Image . 'banner/' . $imgNameNew;
    $notifi = [];
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
    if (!empty($_FILES['img_Banner']['name'])) {
        if (!getimagesize($_FILES['img_Banner']['tmp_name'])) {
            $notifi['image'] = "Trường này nhận dữ liệu dạng ảnh!";
        } else {
            $result = 'SELECT * FROM tbl_banner WHERE  BINARY image = ' . "'$imgNameNew'";
            if (getData($result)) {
                $notifi['image'] = 'Ảnh đã tồn tại hoặc tên ảnh bị trùng (có thể đổi title khác)!';
            }
        }
    } else {
        $notifi['image'] = "Trường này không được bỏ trống!";
    }

    if (!$notifi) {
        $sql = "INSERT INTO tbl_banner(title, image, time_start, time_end) 
                VALUES ('$title', '$imgNameNew', '$time_start', '$time_end')";
        $move_Image = move_uploaded_file($imgTmp, $dirFile);
        if (exeQuery($sql) && $move_Image) {
            $notifi['notifi'] = 'Dữ liệu được thêm thành công!';
            $notifi['status'] = 'susscess-data';
            $flag = true;
        } else {
            $notifi['notifi'] = 'Dữ liệu được thêm thất bại!';
            $notifi['status'] = 'errors-data';
            $flag = false;
        }
    }
}
?>


<div class="table-data">
    <div class="header-table">
        <h3>Thêm banner mới</h3>
        <a href="<?=url_Admin?>/banner" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách Banner
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
            <div class="input-data">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="input-text" value="<?= ($flag) ? '' : ((isset($title)) ? $title : '' ) ?>">
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
                </div>
            </div>
            <div class="input-data">
                <label for="time_start">Time start</label>
                <input type="date" name="time_start" id="time_start" class="input-text" value="<?= ($flag) ? '' : ((isset($time_start)) ? $time_start : '' ) ?>">
                <?php if (isset($notifi['time_start'])) : ?>
                    <span class="errors">
                        <?= $notifi['time_start'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="time_end">Time end</label>
                <input type="date" name="time_end" id="time_end" class="input-text" value="<?= ($flag) ? '' : ((isset($time_end)) ? $time_end : '' ) ?>">
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
                <button id="submit" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once('../layout/footer.php');
?>