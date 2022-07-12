<?php
    include_once('../layout/header.php');
    include_once('../layout/sidebar.php');
?>

<?php
    if(isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] == 'del')
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_role WHERE id = $id";
        if(exeQuery($sql)){
            header("Location:".url_Admin.'/role/index.php');
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
    $sqlTotal = "SELECT COUNT(*) FROM tbl_role WHERE name LIKE '%$text_search%'";
    $total_result = getData($sqlTotal, 1)['COUNT(*)'];
    $total_result_page = 5;
    $total_page = ceil($total_result/$total_result_page);
    $skip_result = $total_result_page * ($page - 1);

    /*
     * lay toan bo du lieu hoac theo tim kiem
     */
    $sql = "SELECT * FROM tbl_role WHERE name LIKE '%$text_search%' LIMIT $total_result_page OFFSET $skip_result";
    $result = getData($sql);
?>



<div class="table-data">
                    <div class="header-table">
                        <h3>Danh sách role</h3>
                        <a href="<?=url_Admin?>/role/create.php" class="a-icon">
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
                                    <th>Name</th>
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
                                        <td class="action-user">
                                            <div class="icon">
                                                <a href="<?=url_Admin?>/role/update.php?id=<?=$value['id']?>" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?=url_Admin?>/role/?action=del&id=<?=$value['id']?>" title="Delete"  onclick="return confirm('Bạn có thực sự muốn xóa dòng dữ liệu này!')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">Không có dữ liệu!</td>
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