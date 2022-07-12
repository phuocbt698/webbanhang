<?php
    include_once('../layout/header.php');
    include_once('../layout/sidebar.php');
?>

<?php
    $sql = "SELECT * FROM tbl_config";
    $result = getData($sql);
?>

<div class="table-data">
                    <div class="header-table">
                        <h3>Thông tin config</h3> 
                    </div>
                    <div class="main-table">
                        <table id="table-data">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Github</th>
                                    <th>Facebook</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($result)):?>
                                    <?php foreach ($result as $value) :?>
                                    <tr>
                                        <td>
                                            <?=$value['email']?>
                                        </td>
                                        <td>
                                            <?=$value['github']?>
                                        </td>
                                        <td>
                                            <?=$value['facebook']?>
                                        </td>
                                        <td>
                                            <?=$value['phone']?>
                                        </td>
                                        <td class="action-user">
                                            <div class="icon">
                                                <a href="<?=url_Admin?>/config/update.php?id=<?=$value['id']?>" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">Không có dữ liệu!</td>
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