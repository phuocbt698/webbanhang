<?php
    include_once('../layout/header.php');
    include_once('../layout/sidebar.php');
?>

<?php
    if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'del')
    {
        $id = $_GET['id'];
        $getImage = "SELECT image FROM tbl_admin WHERE id = $id";
        $nameImage = getData($getImage, 1)['image'];
        $linkImg = foler_Image . 'admin/' . $nameImage;
        var_dump($linkImg);  
        $sql = "DELETE FROM tbl_admin WHERE id = $id";
        if(exeQuery($sql)){
            unlink($linkImg);
            header("Location:".url_Admin.'/user-admin/index.php');
        }        
    }
?>
<?php
    /*
     * Phan trang
     * lay toan bo du lieu hoac theo tim kiem
     */

    /*
     * Phan trang
     */
    $text_search = '';
    if (isset($_GET['key_search']))
    {
        $text_search = $_GET['key_search'];   
    }

    $page = 1;
    if (isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    $sqlTotal = "SELECT COUNT(*) FROM tbl_admin WHERE title LIKE '%$text_search%'";
    $total_result = getData($sqlTotal, 1)['COUNT(*)'];
    $total_result_page = 5;
    $total_page = ceil($total_result/$total_result_page);
    $skip_result = $total_result_page * ($page - 1);

    /*
     * lay toan bo du lieu hoac theo tim kiem
     */
    $sql = "SELECT tbl_admin.*, tbl_role.name AS role_name FROM tbl_admin 
    LEFT JOIN tbl_role ON tbl_admin.role_id = tbl_role.id  WHERE tbl_admin.name LIKE '%$text_search%' LIMIT $total_result_page OFFSET $skip_result";
    $result = getData($sql);
?>



<div class="table-data">
                    <div class="header-table">
                        <h3>Danh sách banner</h3>
                        <a href="<?=url_Admin?>/user-admin/create.php" class="a-icon">
                            <div class="icon">
                                <i class="fas fa-plus"></i>
                                Thêm mới
                            </div>
                        </a>
                        
                    </div>
                    <div class="main-table">
                        <form action="">
                            <input value="<?=$text_search?>" type="search" name="key_search" class="key-search" placeholder="Tìm kiếm tên">
                        </form>
                        <table id="table-data">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($result)):?>
                                    <?php foreach ($result as $value) :?>
                                    <tr>
                                        <td>
                                            <?=$value['name']?>
                                        </td>
                                        <td style="width: 15%;">
                                           <img src=" <?=public_Image?>/admin/<?=$value['image']?>" alt="" style="width: 100%; border-radius: 50%;">
                                        </td>
                                        <td>
                                            <?=$value['email']?>
                                        </td>
                                        <td>
                                            <?=$value['role_name']?>
                                        </td>
                                        <td>
                                            <?=format_time($value['birthday'])?>
                                        </td>
                                        <td>
                                            <?=$value['address']?>
                                        </td>
                                        <td class="action-user">
                                            <div class="icon">
                                                <a href="<?=url_Admin?>/user-admin/update.php?id=<?=$value['id']?>" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?=url_Admin?>/user-admin/detail.php?id=<?=$value['id']?>" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?=url_Admin?>/user-admin/?action=del&id=<?=$value['id']?>" title="Delete"  onclick="return confirm('Bạn có thực sự muốn xóa dòng dữ liệu này!')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">Không có dữ liệu!</td>
                                    </tr>
                                <?php endif;?>
                                
                            </tbody>
                          </table>
                    </div>
                    <div class="page-list">
                        <?php for ($i=1; $i<=$total_page; $i++) : ?>
                            <a href="?page=<?= $i ?>&text_search=<?=$text_search?>"><?= $i ?></a>
                        <?php endfor; ?>
                    </div>
                </div>
<?php
    include_once('../layout/footer.php');
?>