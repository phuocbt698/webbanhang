<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_role WHERE id = $id";
        $result = getData($sql, 1);
        if(empty($result)){
            header("Location:" . url_Admin .'/role');
        }
    }
?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $notifi = [];
    if (validate_str($name)) {
        $notifi['name'] = validate_str($name);
    }
    if (!$notifi) {   
        $sqlUpdate = "UPDATE tbl_role SET name = '$name' WHERE id = $id";
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
        <h3>Chỉnh sửa role</h3>
        <a href="<?= url_Admin ?>/role" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách role
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
            <div class="input-data">
                <label for="name">Title</label>
                <input type="text" name="name" id="name" class="input-text" value="<?= (isset($name)) ? $name: $result['name'] ?>">
                <?php if (isset($notifi['name'])) : ?>
                    <span class="errors">
                        <?= $notifi['name'] ?>
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