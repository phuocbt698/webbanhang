<div class="sidebar">
                <h3>Menu quản lý</h3>
                <a href="<?=url_Admin?>" class="button <?=(folder_Name == '') ? 'btn-active' : '' ?>">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </a>
                <a href="<?=url_Admin?>/banner" class="button <?=(folder_Name == 'banner') ? 'btn-active' : '' ?>">
                    <i class="fas fa-bookmark"></i>
                    Banner
                </a>
                <a href="<?=url_Admin?>/category" class="button <?=(folder_Name == 'category') ? 'btn-active' : '' ?>">
                    <i class="fas fa-list-ul"></i>
                    Category
                </a>
                <a href="<?=url_Admin?>/product" class="button <?=(folder_Name == 'product') ? 'btn-active' : '' ?>">
                    <i class="fas fa-cubes"></i>
                    Product
                </a>
                <a href="<?=url_Admin?>/order" class="button <?=(folder_Name == 'order') ? 'btn-active' : '' ?>">
                    <i class="fas fa-shopping-cart"></i>
                    Order
                </a>
                <a href="<?=url_Admin?>/customer" class="button <?=(folder_Name == 'customer') ? 'btn-active' : '' ?>">
                    <i class="fas fa-users"></i>
                    Customer
                </a>
                <a href="<?=url_Admin?>/user-admin" class="button <?=(folder_Name == 'user-admin') ? 'btn-active' : '' ?>">
                    <i class="fas fa-user-shield"></i>
                    User-admin
                </a>
                <a href="<?=url_Admin?>/role" class="button <?=(folder_Name == 'role') ? 'btn-active' : '' ?>">
                    <i class="fas fa-user-cog"></i>
                    Role
                </a>
                <a href="<?=url_Admin?>/config" class="button <?=(folder_Name == 'config') ? 'btn-active' : '' ?>">
                    <i class="fas fa-cogs"></i>
                    Config-web
                </a>
            </div>
            <div class="content-main">