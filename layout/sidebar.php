<?php
    if(isset($resultCategory)){
        $resultCategory = $resultCategory;
    }
    if(isset($_GET['text_search'])){
        $text_search = $_GET['text_search'];
    }
?>

<div class="main">
    <div class="sidebar">
        <div class="menu-category">
            <ul class="category">
                <li>
                    <i class="fas fa-bars"></i>
                    <span>Danh mục sản phẩm</span>
                    <ul class="sub-menu dropdown_menu">
                        <?php foreach($resultCategory as $category): ?>
                            <a href="?text_search=<?=$text_search?>&id=<?=$category['id']?>">
                                <li><?= ucfirst($category['name'])?></li>
                            </a>
                        <?php endforeach?>                   
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu-sidebar">
            <ul class="list-menu">
                <li>
                    <i class="fas fa-home"></i>
                    <a href="/index.php">Trang chủ</a>
                </li>
                <li>
                    <i class="fas fa-info-circle"></i>
                    <a title="Chức năng chưa hoàn thiện!">Giới thiệu</a>
                </li>
                <li class="product">
                    <i class="fab fa-product-hunt"></i>
                    <span>Sản phẩm</span>
                    <ul class="sub-menu-product dropdown_menu">
                    <?php foreach($resultCategory as $category): ?>
                            <a href="?text_search=<?=$text_search?>&id=<?=$category['id']?>">
                                <li><?= ucfirst($category['name'])?></li>
                            </a>
                        <?php endforeach?>           
                    </ul>
                </li>
                <li>
                    <i class="fas fa-newspaper"></i>
                    <a title="Chức năng chưa hoàn thiện!">
                        Tin tức
                    </a>
                </li>
                <li>
                    <i class="fas fa-address-book"></i>
                    <a title="Chức năng chưa hoàn thiện!">Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>