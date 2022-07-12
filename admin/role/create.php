<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>

<?php
if (isset($_POST['submit'])) {
    $notifi = [];
    $name = $_POST['name'];
    if(validate_str($name)) {
        $notifi['name'] = validate_str($name);
    }
    else{
        $result = 'SELECT * FROM tbl_role WHERE name LIKE ' . "'%$name%'";
        if (getData($result)) {
            $notifi['name'] = 'Category đã tồn tại hãy tạo một category khác!';
        }
    }
    
    if (!$notifi) {      
        $sql = "INSERT INTO tbl_role(name) VALUES ('$name')";
        if (exeQuery($sql)) {
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
        <h3>Thêm role mới</h3>
        <a href="<?=url_Admin?>/role" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách role
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST">
            <div class="input-data">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="input-text" value="<?= ($flag) ? '' : ((isset($name)) ? $name : '' ) ?>">
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
                <button id="submit" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once('../layout/footer.php');
?>