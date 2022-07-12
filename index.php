<?php
    include_once('./layout/header.php');
    include_once('./layout/sidebar.php');
    include_once('./layout/slide.php');
?>

<?php
    $text_search = '';
    $id_category = '';
    $typePrice = '';
    if(isset($_GET['text_search']))
    {
        $text_search = $_GET['text_search'];
    }
    if(isset($_GET['id']))
    {
        $id_category = $_GET['id'];
    }
    if(isset($_GET['typePrice'])){
        ($_GET['typePrice'] == 'up') ? $typePrice = 'ASC' : $typePrice = 'DESC';
    }
    $total_result_page = 10;
    $page = 1;
    if(empty($id_category)){
        $sqlProductTotal = "SELECT COUNT(*) FROM tbl_product WHERE name LIKE '%$text_search%'";
        $total_result = getData($sqlProductTotal, 1)['COUNT(*)'];  
        $total_page = ceil($total_result/$total_result_page);
        $skip_result = $total_result_page * ($page - 1);
        $sqlProduct = "SELECT * FROM tbl_product WHERE name LIKE '%$text_search%' ORDER BY price $typePrice LIMIT $total_result_page  OFFSET $skip_result";
    }
    else{
        $sqlProductTotal = "SELECT COUNT(*) FROM tbl_product WHERE name LIKE '%$text_search%' AND category_id = $id_category"; 
        $total_result = getData($sqlProductTotal, 1)['COUNT(*)'];    
        $total_page = ceil($total_result/$total_result_page);
        $skip_result = $total_result_page * ($page - 1);
        $sqlProduct = "SELECT * FROM tbl_product WHERE name LIKE '%$text_search%' AND category_id = $id_category ORDER BY price $typePrice LIMIT $total_result_page  OFFSET $skip_result";
    }
    $resultProduct = getData($sqlProduct);
    $sqlProductNew = "SELECT * FROM tbl_product ORDER BY id DESC LIMIT 5";
    $resultProductNew = getData($sqlProductNew);
?>

<div class="content">
    <div class="product-hot products">
        <div class="title">
            <div class="title-icon">
                <h3>Sản phẩm mới</h3>
                <i class="fab fa-hotjar"></i>
            </div>
        </div>
        <div class="list-product">
            <?php foreach($resultProductNew as $productNew) : ?>
                <div class="product">
                    <img src="<?=link_Image .'product/' . $productNew['image']?>" alt="">
                <div class="info">
                    <span><?=$productNew['name']?></span>
                    <span><?=number_format($productNew['price'])?> VND</span>
                </div>
                <div class="action">
                    <a href="/product.php?id=<?=$productNew['id']?>">
                        <i class="fas fa-info"></i>
                    </a>
                    <a href="process_cart.php?id=<?=$productNew['id']?>">
                        <i class="fas fa-cart-plus"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="product-new products">
        <div class="title">
            <div class="title-icon">
                <h3>Danh sách sản phẩm</h3>
                <i class="fas fa-asterisk"></i>
            </div>
            <div class="filter-price">
                <h3>Sắp xếp theo giá:</h3>
                <a href="?text_search=<?=$text_search?>&id=<?=$id_category?>&typePrice=down">
                    <i class="fas fa-sort-amount-down"></i>
                    <span>Cao - Thấp</span>
                </a>
                <a href="?text_search=<?=$text_search?>&id=<?=$id_category?>&typePrice=up">
                    <i class="fas fa-sort-amount-down-alt"></i>
                    <span>Thấp - Cao</span>
                </a>
            </div>
        </div>
        <div class="list-product">
            <?php foreach($resultProduct as $product): ?>
                <div class="product">
                    <img src="<?=link_Image . 'product/'. $product['image']?>" alt="">
                    <div class="info">
                        <span><?= $product['name'] ?></span>
                        <span><?= number_format($product['price']) ?> VND</span>
                    </div>
                    <div class="action">
                        <a href="/product.php?id=<?=$product['id']?>">
                        <i class="fas fa-info"></i>
                        </a>
                        <a href="process_cart.php?id=<?=$product['id']?>">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="paging-product">
            <?php for ($i=1; $i<=$total_page; $i++) : ?>
                <a href="?page=<?= $i ?>&text_search=<?=$text_search?>&id=<?=$id_category?>&typePrice=<?=$typePrice?>>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</div>
<?php
    include_once('./layout/footer.php');
?>