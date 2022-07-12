<?php
    include_once('../admin/layout/header.php');
    include_once('../admin/layout/sidebar.php');
    define('doc_Root', $_SERVER['DOCUMENT_ROOT']) ;
?>
<?php
    include_once doc_Root . "/database/db_helper.php";
    include_once doc_Root . "/database/validate.php";
    $sqlOrderNew = "SELECT COUNT('status') FROM tbl_order WHERE status = 0";
    $sqlCustomer = "SELECT COUNT('*') FROM tbl_customer";
    $sqlTotalPrice = "SELECT SUM(total_price) as total FROM tbl_order WHERE status = 2";
    $orderNew = getData($sqlOrderNew, 1)["COUNT('status')"]; 
    $customer = getData($sqlCustomer, 1)["COUNT('*')"];
    $totalPrice = getData($sqlTotalPrice, 1)['total'];
?>

<div class="table-data">
    <div class="header-dashboard">
        <div class="quick-info new-order">
            <i class="fas fa-cart-plus"></i>
            <div class="content">
                <h2>Đơn hàng mới</h2>
                <span><?= $orderNew ?></span>
            </div>
        </div>
        <div class="quick-info unique-visitors">
            <i class="fas fa-user-clock"></i>
            <div class="content">
                <h2>Doanh thu</h2>
                <span><?= number_format($totalPrice)?> VND</span>
            </div>
        </div>
        <div class="quick-info user-new">
            <i class="fas fa-user-plus"></i>
            <div class="content">
                <h2>Thành viên</h2>
                <span><?= $customer ?></span>
            </div>
        </div>
    </div>
    <div class="chart-data">
        <h2>Bản đồ thống kê</h2> 
        <div class="select-chart">
            <form action="" class="form-chart">
                <div class="input-data">
                    <label for="">Lựa chọn biểu đồ:</label>
                    <select name="" id="">
                        <option value="">Doanh thu</option>
                        <option value="">Sản phẩm bán chạy</option>
                    </select>
                </div>
                <div class="input-data">
                    <div class="date-from">
                        <label for="">Từ:</label>
                        <input type="date" name="" id="">
                    </div>
                    <div class="date-end">
                        <label for="">Từ:</label>
                        <input type="date" name="" id="">
                    </div>
                </div>                             
            </form>
        </div> 
        <div class="content-chart" id="chart">

        </div>                      
    </div>
</div>
<script>
        Highcharts.chart('chart', {
    
            title: {
                text: 'THỐNG KÊ DOANH THU'
            },
    
            yAxis: {
                title: {
                    text: ''
                }
            },
    
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
    
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
    
            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                }
            },
    
            series: [{
                name: 'Doanh thu',
                data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
            },
            {
                name: 'Doanh thu',
                data: [8000, 8000, 57177, 69658, 97031, 119931, 8000, 154175]
            }],
    
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
    
        });
    </script>
<?php
    include_once('../admin/layout/footer.php');
?>