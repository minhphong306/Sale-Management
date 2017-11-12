<!--Nav bar-->
<nav class="shop-navbar navbar navbar-default" >
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">24hMart</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nhập sản phẩm cần tìm">
                </div>
                <button type="submit" class="btn btn-default">Tìm kiếm</button>
                <div class="form-group shop-form-btn">
                    <a href="cart.php" class="btn btn-success"><i class="fa fa-shopping-cart"></i></a>

                </div>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php">Trang chủ </a></li>
                <li><a href="product.php">Sản phẩm</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Danh mục <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li ng-repeat="item in parent_categories">
                            <a href="category.php?id={{item.id}}">{{item.name}}</a>
                        </li>

                    </ul>
                </li>
                <li><a href="admin">Quản trị</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--End Nav bar-->