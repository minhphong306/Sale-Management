<?php
session_start();
if (!isset($_SESSION['is_logined'])) {
    header("Location: login.php");
}
?>

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">24h Mart Manager</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?php
                $now_hour = date("h");
                if($now_hour < 12){
                    $greeting = "buổi sáng";
                } else if($now_hour < 18){
                    $greeting = "buổi chiều";
                } else {
                    $greeting = "buổi tối";
                }
                echo "Chào $greeting {$_SESSION['staff_name']} ({$_SESSION['username']})";
                ?> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</a>
                </li>
                <li><a href="/Sale_Manage/index.php"><i class="fa fa-user fa-fw"></i> Về trang bán hàng</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Tìm kiếm">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Trang chủ</a>
                </li>
                <li>
                    <a href="receipt.php"><i class="fa fa-cart-arrow-down fa-fw"></i> Nhập hàng</a>
                </li>
                <li>
                    <a href="customer.php"><i class="fa fa-file-pdf-o fa-fw"></i> Khách hàng</a>
                </li> 
                <li>
                    <a href="provider.php"><i class="fa fa-database fa-fw"></i> Nhà cung cấp</a>
                </li> 
                <li>
                    <a href="category.php"><i class="fa fa-object-group fa-fw"></i> Danh mục</a>
                </li>
                <li>
                    <a href="unit.php"><i class="fa fa-universal-access fa-fw"></i> Đơn vị</a>
                </li>
                
                <li>
                    <a href="account.php"><i class="fa fa-users fa-fw"></i> Tài khoản</a>
                </li> 
                <li>
                    <a href="staff.php"><i class="fa fa-table fa-fw"></i> Nhân viên</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cubes fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="product.php">  Danh sách</a>
                        </li>
                        <li>
                            <a href="product_add.php">  Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> Hóa đơn<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="orderin.php">  Hóa đơn nhập</a>
                        </li>
                        <li>
                            <a href="orderout.php">  Hóa đơn xuất</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                 <li>
                    <a href="#"><i class="fa fa-bolt fa-fw"></i> Khuyến mại<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="promotion.php">  Danh sách</a>
                        </li>
                        <li>
                            <a href="promotion_add.php">  Thêm mới</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

