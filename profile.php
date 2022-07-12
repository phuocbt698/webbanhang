<?php
    include_once('./layout/header.php');
    include_once('./layout/sidebar.php');
?>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sqlUser = "SELECT * FROM tbl_customer WHERE id = $id";
        $resultUser = getData($sqlUser, 1);
    }
?>
<?php
if (isset($_POST['submit'])) {
    var_dump($_FILES);
    $notifi = [];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $address = $_POST['address'];
    if(!empty($_FILES['image']['name'])){
        $imgName = $_FILES['image']['name'];
        $imgType = str_replace("image/", '', $_FILES['image']['type']);
        $imgTmp = $_FILES['image']['tmp_name'];
        $imgNameNew = create_slug($imgName) . '.' .$imgType;
        $dirFile = public_Image . 'user/' . $imgNameNew;
        if (!getimagesize($_FILES['image']['tmp_name'])) {
            $notifi['image'] = "Trường này nhận dữ liệu dạng ảnh!";
        } else {
            $result = 'SELECT * FROM tbl_customer WHERE  BINARY image = ' . "'$imgNameNew'";
            if (getData($result)) {
                $notifi['image'] = 'Ảnh đã tồn tại hoặc tên ảnh bị trùng (có thể đổi name khác)!';
            }
        }
    }

    if (empty($name)) {
        $notifi['name'] = validate_Str($name);
    }
    if (empty($email)) {
        $notifi['email'] = validate_Str($email);
    }else{
        if(!strcmp($resultUser['email'], $email)){
            $email = $email;
        }
        else{
            $sqlEmail = 'SELECT * FROM tbl_customer WHERE  BINARY email = ' . "'$email'";
            if(getData($sqlEmail)){
                $notifi['email'] = 'Email đã tồn tại';
            }
            $email = $email;
        }
    }
    if (validate_Str($password)) {
        $notifi['password'] = validate_Str($password);
    }else{
        if(!strcmp($resultUser['password'], $password)){
            $password = $password;
        }
        else{
            $password = md5($password);
        }
    }
    if(validate_Date($birthday)){
        $notifi['birthday'] = validate_Date($birthday);
    }
    if(empty($address)){
        $notifi['address'] = validate_Str($address);
    }

    if (!$notifi) {   
        if($imgNameNew){
            unlink(public_Image.'user/'.$resultUser['image']);
            $move_Image = move_uploaded_file($imgTmp, $dirFile);            
            $sqlUpdate = "UPDATE tbl_customer SET name = '$name', phone = '$phone', email = '$email', password = '$password', image = '$imgNameNew', birthday = '$birthday', address = '$address' WHERE id = $id";       
        }
        else{
            $sqlUpdate = "UPDATE tbl_customer SET name = '$name', phone = '$phone', email = '$email', password = '$password', birthday = '$birthday', address = '$address' WHERE id = $id";
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

<div class="content">
    <div class="info_user">
        <div class="header_info">
            <h2>Thông tin khách hàng</h2>
            <span>(Bạn có thể trực tiếp cập nhật thông tin của mình tại đây!)</span>
        </div>
        <div class="image">
            <img src="<?=link_Image . 'user/' . $resultUser['image']?>" alt="">
        </div>
        <div class="main_user">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input">
                    <label for="name_info">Họ tên khách hàng</label>
                    <input type="text" id="name_info" name="name" value="<?=(isset($resultUser) ? $resultUser['name'] : '')?>">
                    <?php if (isset($notifi['name'])) : ?>
                    <span class="errors">
                        <?= $notifi['name'] ?>
                    </span>
                <?php endif; ?>
                </div>
                <div class="input">
                    <label for="email_info">Email</label>
                    <input type="text" id="email_info" name="email" value="<?=(isset($resultUser) ? $resultUser['email'] : '')?>">
                    <?php if (isset($notifi['email'])) : ?>
                    <span class="errors">
                        <?= $notifi['email'] ?>
                    </span>
                <?php endif; ?>
                </div>
                <div class="input">
                    <label for="phone_info">Phone</label>
                    <input type="text" id="phone_info" name="phone" value="<?=(isset($resultUser) ? $resultUser['phone'] : '')?>">
                    <?php if (isset($notifi['phone'])) : ?>
                        <span class="errors">
                            <?= $notifi['phone'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="input">
                    <label for="password_info">Password</label>
                    <input autocomplete="off" type="password" id="password_info" name="password" value="<?=(isset($resultUser) ? $resultUser['password'] : '')?>">
                    <?php if (isset($notifi['password'])) : ?>
                        <span class="errors">
                            <?= $notifi['password'] ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="input">
                    <label for="birthday_info">Ngày sinh</label>
                    <input type="date" id="birthday_info" name="birthday" value="<?=(isset($resultUser) ? format_time($resultUser['birthday'], 'Y-m-d') : '')?>">
                    <?php if (isset($notifi['birthday'])) : ?>
                    <span class="errors">
                        <?= $notifi['birthday'] ?>
                    </span>
                <?php endif; ?>
                </div>
                <div class="input">
                    <label for="address_info">Địa chỉ</label>
                    <input type="text" id="address_info" name="address" value="<?=(isset($resultUser) ? $resultUser['address'] : '')?>">
                    <?php if (isset($notifi['address'])) : ?>
                    <span class="errors">
                        <?= $notifi['address'] ?>
                    </span>
                <?php endif; ?>
                </div>
                <div class="input">
                    <label for="image">Ảnh</label>
                    <input type="file" id="imageUserInfo" name="image">
                    <?php if (isset($notifi['image']) && !(isset($notifi['status'])  == 'errors-data' )) : ?>
                        <span class="errors">
                            <?= $notifi['image'] ?>
                        </span>
                    <?php endif; ?>
                    <div class="previewInfo">
                        
                    </div>
                </div>
                <?php if (isset($notifi['notifi'])) : ?>
                    <span class="<?= $notifi['status'] ?>">
                        <?= $notifi['notifi'] ?>
                    </span>
                <?php endif; ?>
                <div class="submit">
                    <button type="submit" name="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include_once('./layout/footer.php');
?>
<script>
    $(document).ready(function(){
        $('#imageUserInfo').change(function(e) {
            const preview = document.querySelector('.previewInfo')
            const img_preview_old = document.querySelector('.img-preview');
            const files = e.target.files;
            const file = files[0];
            const fileType = file['type'];
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = function() {
                const url = fileReader.result;
                console.log(url);
                if (img_preview_old) {
                    img_preview_old.remove();
                }
                if (!file['type'].search('image')) {
                    preview.insertAdjacentHTML(
                        'beforeend',
                        `<img src="${url}" alt="${file.name}" class="img-preview"/>`
                    )
                }
            }
            console.log('aa');
        });
    });
</script>