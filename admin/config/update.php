<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_config WHERE id = $id";
        $result = getData($sql, 1);
        if(empty($result)){
            header("Location:" . url_Admin .'/config');
        }
    }
?>
<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $github = $_POST['github'];
    $facebook = $_POST['facebook'];
    $phone = $_POST['phone'];
    $notifi = [];
    if (validate_Email($email)) {
        $notifi['email'] = validate_Email($name);
    }
    if (validate_Str($github)) {
        $notifi['github'] = validate_str($github);
    }
    if (validate_Str($facebook)) {
        $notifi['facebook'] = validate_Str($facebook);
    }
    if (validate_Phone($phone)) {
        $notifi['phone'] = validate_Phone($phone);
    }
    if (!$notifi) {   
        $sqlUpdate = "UPDATE tbl_category SET name = '$name' WHERE id = $id";
        if (exeQuery($sqlUpdate)) {
            $notifi['notifi'] = 'Dữ liệu được cập nhật thành công!';
            $notifi['status'] = 'susscess-data';
        } else {
            $notifi['notifi'] = 'Dữ liệu được cập nhật thất bại!';
            $notifi['status'] = 'errors-data';
        }
    }
}
?>
<div class="table-data">
    <div class="header-table">
        <h3>Chỉnh sửa config</h3>
        <a href="<?= url_Admin ?>/config" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Thông tin config
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
            <div class="input-data">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-text" value="<?= (isset($email)) ? $email: $result['email'] ?>">
                <?php if (isset($notifi['email'])) : ?>
                    <span class="errors">
                        <?= $notifi['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="github">Github</label>
                <input type="github" name="github" id="github" class="input-text" value="<?= (isset($github)) ? $github: $result['github'] ?>">
                <?php if (isset($notifi['github'])) : ?>
                    <span class="errors">
                        <?= $notifi['github'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="facebook">Facebook</label>
                <input type="facebook" name="facebook" id="facebook" class="input-text" value="<?= (isset($facebook)) ? $facebook: $result['facebook'] ?>">
                <?php if (isset($notifi['facebook'])) : ?>
                    <span class="errors">
                        <?= $notifi['facebook'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="phone">Phone</label>
                <input type="phone" name="phone" id="phone" class="input-text" value="<?= (isset($phone)) ? $phone: $result['phone'] ?>">
                <?php if (isset($notifi['phone'])) : ?>
                    <span class="errors">
                        <?= $notifi['phone'] ?>
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