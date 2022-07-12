<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
    $sqlCategory = "SELECT * FROM tbl_category";
    $resultCategory = getData($sqlCategory);
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_product WHERE id = $id";
        $result = getData($sql, 1);
        if(empty($result)){
            header("Location:" . url_Admin .'/product');
        }
    }
?>
<?php
if (isset($_POST['submit'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $notifi = [];
    if(!empty($_FILES['img_Product']['name'])){
        $imgName = $_FILES['img_Product']['name'];
        $imgType = str_replace("image/", '', $_FILES['img_Product']['type']);
        $imgTmp = $_FILES['img_Product']['tmp_name'];
        $imgNameNew = create_slug($imgName) . '.' .$imgType;
        $dirFile = foler_Image . 'product/' . $imgNameNew;
        if (!getimagesize($_FILES['img_Product']['tmp_name'])) {
            $notifi['image'] = "Trường này nhận dữ liệu dạng ảnh!";
        } 
    }
    
    if (validate_str($category_id)) {
        $notifi['category'] = 'Trường này cần được chọn!';
    }
    if (validate_str($name)) {
        $notifi['name'] = validate_str($name);
    }
    if (!$description) {
        $notifi['description'] = 'Trường này không được bỏ trống!';
    }
    if (validate_num($price)) {
        $notifi['price'] = validate_num($price);
    }
    if (validate_num($quantity)) {
        $notifi['quantity'] = validate_num($quantity);
    }
    if (!$notifi) {   
        if($imgNameNew){
            $move_Image = move_uploaded_file($imgTmp, $dirFile);
            unlink(foler_Image.'product/'.$result['image']);
            $sqlUpdate = "UPDATE tbl_product SET category_id = '$category_id', name = '$name', image = '$imgNameNew', description = '$description', price = $price, quantity = $quantity WHERE id = $id";       
        }
        else{
            $sqlUpdate = "UPDATE tbl_product SET category_id = '$category_id', name = '$name', description = '$description', price = $price, quantity = $quantity WHERE id = $id";
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
        <h3>Thêm product mới</h3>
        <a href="<?=url_Admin?>/product" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách product
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
            <div class="input-data">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id">
                    <option value="">Lựa chọn</option>
                    <?php foreach($resultCategory as $category): ?>
                        <option <?= ($result['category_id'] == $category['id']) ? 'selected' :'' ?> value="<?=$category['id']?>"><?=ucfirst($category['name'])?></option>
                    <?php endforeach;?>
                </select>
                <?php if (isset($notifi['category'])) : ?>
                    <span class="errors">
                        <?= $notifi['category'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="input-text" value="<?= (isset($result['name'])) ? $result['name'] : '' ?>">
                <?php if (isset($notifi['name'])) : ?>
                    <span class="errors">
                        <?= $notifi['name'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
            <label for="img_Product">Image</label>
                <input type="file" name="img_Product" id="img_Product" class="input-file">
                <?php if (isset($notifi['image'])) : ?>
                    <span class="errors">
                        <?= $notifi['image'] ?>
                    </span>
                <?php endif; ?>
                <div class="preview">
                    <label for="">Ảnh cũ</label>
                    <img src="<?=($imgNameNew) ? public_Image. 'product/' . $imgNameNew : public_Image. 'product/' . $result['image']?>" alt="" class="imageOld">
                </div>
            </div>
            <div class="input-data">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10">
                    <?=$result['description']?>
                </textarea>
                <?php if (isset($notifi['description'])) : ?>
                    <span class="errors">
                        <?= $notifi['description'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="input-text" value="<?= (isset($result['price'])) ? $result['price'] : '' ?>">
                <?php if (isset($notifi['price'])) : ?>
                    <span class="errors">
                        <?= $notifi['price'] ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="input-data">
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" id="quantity" class="input-text" value="<?= (isset($result['quantity'])) ? $result['quantity'] : '' ?>">
                <?php if (isset($notifi['quantity'])) : ?>
                    <span class="errors">
                        <?= $notifi['quantity'] ?>
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
<script>
    CKEDITOR.replace( 'description' );
</script>
<?php
include_once('../layout/footer.php');
?>