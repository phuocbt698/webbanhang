<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
    $sqlRole = "SELECT * FROM tbl_role";
    $resultRole = getData($sqlRole);
?>
<?php
if (isset($_POST['submit'])) {
    $notifi = [];
    $role_id = $_POST['role_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    $imgName = $_FILES['img_Admin']['name'];
    $imgType = str_replace("image/", '', $_FILES['img_Admin']['type']);
    $imgTmp = $_FILES['img_Admin']['tmp_name'];
    $imgNameNew = create_slug($imgName) . '.' .$imgType;
    $dirFile = foler_Image . 'admin/' . $imgNameNew;
    if (validate_Str($role_id)) {
        $notifi['role_id'] = 'Trường này cần được chọn!';
    }
    if (empty($name)) {
        $notifi['name'] = validate_Str($name);
    }
    if (empty($email)) {
        $notifi['email'] = validate_Email($email);
    }else{
        $result = 'SELECT * FROM tbl_admin WHERE  BINARY email = ' . "'$email'";
        if (getData($result)) {
            $notifi['email'] = 'Email đã tồn tại!';
        }
    }
    if (validate_Str($password)) {
        $notifi['password'] = validate_Str($password);
    }else{
        $password = md5($password);
    }
    if(validate_Date($birthday)){
        $notifi['birthday'] = validate_Date($birthday);
    }
    if(empty($address)){
        $notifi['address'] = validate_Str($address);
    }

    if (!empty($_FILES['img_Admin']['name'])) {
        if (!getimagesize($_FILES['img_Admin']['tmp_name'])) {
            $notifi['image'] = "Trường này nhận dữ liệu dạng ảnh!";
        } else {
            $result = 'SELECT * FROM tbl_admin WHERE  BINARY image = ' . "'$imgNameNew'";
            if (getData($result)) {
                $notifi['image'] = 'Ảnh đã tồn tại hoặc tên ảnh bị trùng (có thể đổi name khác)!';
            }
        }
    } else {
        $notifi['image'] = "Trường này không được bỏ trống!";
    }

    if (!$notifi) {
        $sql = "INSERT INTO tbl_admin(name, email, password, role_id, image, birthday, address) 
                VALUES ('$name', '$email', '$password', '$role_id', '$imgNameNew', '$birthday', '$address')";
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
        <a href="<?=url_Admin?>/user-admin" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách user-admin
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
        <div class="input-data">
                <label for="role_id">Role</label>
                <select name="role_id" id="role_id">
                    <option value="">Lựa chọn</option>
                    <?php foreach($resultRole as $role): ?>
                        <option <?= ($flag) ? '' : (($role_id == $role['id']) ? 'selected' :'' )?> value="<?=$role['id']?>"><?=ucfirst($role['name'])?></option>
                    <?php endforeach;?>
                </select>
                <?php if (isset($notifi['role_id'])) : ?>
                    <span class="errors">
                        <?= $notifi['role_id'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="input-text" value="<?= ($flag) ? '' : ((isset($name)) ? $name : '' ) ?>">
                <?php if (isset($notifi['name'])) : ?>
                    <span class="errors">
                        <?= $notifi['name'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="input-text" value="<?= ($flag) ? '' : ((isset($email)) ? $email : '' ) ?>">
                <?php if (isset($notifi['email'])) : ?>
                    <span class="errors">
                        <?= $notifi['email'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="email">Password</label>
                <input type="password" name="password" id="password" class="input-text" value="<?= ($flag) ? '' : ((isset($password)) ? $password : '' ) ?>">
                <?php if (isset($notifi['password'])) : ?>
                    <span class="errors">
                        <?= $notifi['password'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="img_Admin">Image</label>
                <input type="file" name="img_Admin" id="img_Admin" class="input-file">
                <?php if (isset($notifi['image'])) : ?>
                    <span class="errors">
                        <?= $notifi['image'] ?>
                    </span>
                <?php endif; ?>
                <div class="preview">
                </div>
            </div>
            <div class="input-data">
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" id="birthday" class="input-text" value="<?= ($flag) ? '' : ((isset($birthday)) ? $birthday : '' ) ?>">
                <?php if (isset($notifi['birthday'])) : ?>
                    <span class="errors">
                        <?= $notifi['birthday'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="address">Address</label>
                <textarea name="address" id="address" cols="30" rows="10"><?=($flag) ? '' : $address?></textarea>
                <?php if (isset($notifi['address'])) : ?>
                    <span class="errors">
                        <?= $notifi['address'] ?>
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