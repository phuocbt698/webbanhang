<?php
include_once('../layout/header.php');
include_once('../layout/sidebar.php');
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id = $id";
        $result = getData($sql, 1);
        if(empty($result)){
            header("Location:" . url_Admin .'/order');
        }
    }
?>
<?php
if (isset($_POST['submit'])) {
    $status = $_POST['status'];
    $id_Admin =  $_SESSION['admin']['id'];
        $sqlUpdate = "UPDATE tbl_order SET status = $status, admin_id = $id_Admin WHERE id = $id";
        if (exeQuery($sqlUpdate)) {
            $notifi['notifi'] = 'Dữ liệu được cập nhật thành công!';
            $notifi['status'] = 'susscess-data';
        } else {
            $notifi['notifi'] = 'Dữ liệu được cập nhật thất bại!';
            $notifi['status'] = 'errors-data';
        }
}
?>
<div class="table-data">
    <div class="header-table">
        <h3>Chỉnh sửa category</h3>
        <a href="<?= url_Admin ?>/order" class="a-icon">
            <div class="icon">
                <i class="fas fa-list"></i>
                Danh sách category
            </div>
        </a>
    </div>
    <div class="form-data">
        <form action="" id="form-submit" class="create-data" method="POST" enctype="multipart/form-data">
            <div class="input-data">
                <label for="status">Status</label>
               <select name="status" id="status">
                <option value="0">Đang chờ</option>
                <option value="1">Đang giao hàng</option>
                <option value="2">Hoàn thành</option>
                <option value="3">Hủy đơn hàng</option>
               </select>
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