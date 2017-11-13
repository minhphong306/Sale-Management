<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Đơn vị - Quản lý bán hàng</title>
        <?php
        include './partial/header.php';
        ?>
        <link href="template/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="template/pnotify/pnotify.custom.min.js" type="text/javascript"></script>
        <!--Angular-->
        <script src="angular/lib/angular.min.js"></script>
        <script src="angular/module/app.js" type="text/javascript"></script>
        <script src="template/ng-table/ng-table.min.js"></script>
        <link href="template/ng-table/ng-table.min.css" rel="stylesheet" type="text/css">
        <script src="angular/service/ProductService.js" type="text/javascript"></script>
        <script src="angular/service/ProviderService.js" type="text/javascript"></script>
        <script src="angular/service/ReceiptService.js" type="text/javascript"></script>
        <script src="angular/controller/ReceiptController.js" type="text/javascript"></script>


    </head>
    <body ng-controller="receiptCtrl">
        <div id="wrapper">
            <!-- Navigation and menu-->
            <?php
            include './partial/navbar_menu.php';
            ?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Nhập hàng </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">


                        <div class="col-md-12" style="padding: 20px">
                            <form class="form-horizontal">
                                <fieldset>
                                    <legend>Thông tin đơn hàng</legend>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Nhân viên</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control disabled" disabled placeholder="Nhập tên sản phẩm"  value="<?php echo $_SESSION['staff_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Nhà cung cấp</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" ng-model="selected_provider"  ng-options="item.name for item in providers">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Ghi chú</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3" ng-model="bill_note" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="height: 250px; overflow: auto;">
                                        <form>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                    <input type="text" class="form-control" placeholder="Nhập dữ liệu cần tìm kiếm" ng-model="productSearchQuery">
                                                </div>      
                                            </div>
                                        </form>
                                        <table class="table table-bordered table-hover" style=" cursor: pointer; ">
                                            <thead>
                                                <tr>
                                                    <th><a href="#">#</a></th>
                                                    <th><a href="" ng-click="productSortType = 'id'; productSortReverse = !productSortReverse">Mã SP</a></th>
                                                    <th><a href="" ng-click="productSortType = 'name'; productSortReverse = !productSortReverse">
                                                            Tên SP
                                                            <span ng-show="productSortType == 'name' && !productSortReverse" class="fa fa-caret-down"></span>
                                                            <span ng-show="productSortType == 'name' && productSortReverse" class="fa fa-caret-up"></span>
                                                        </a>
                                                    </th>
                                                    <th>
                                                        <a href="" ng-click="parentCategorySortType = 'price_in'; productSortReverse = !productSortReverse">
                                                            Đơn giá nhập
                                                            <span ng-show="productSortType == 'price_in' && !productSortReverse" class="fa fa-caret-down"></span>
                                                            <span ng-show="productSortType == 'price_in' && productSortReverse" class="fa fa-caret-up"></span>
                                                        </a>
                                                    </th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in products| orderBy:productSortType:productSortReverse | filter:productSearchQuery" ng-if="item.is_deleted != 1" ng-click="getChildCategory(item.id)">
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{item.id}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>{{item.price_in}}</td>
                                                    <td>
                                                        <button  ng-click="addToCart(item)"  class="btn btn-circle btn-info"  data-toggle="modal" data-target="#myModalEdit" >
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <legend>Danh sách sản phẩm</legend>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr ng-repeat="item in carts">
                                            <td>{{$index}}</td>
                                            <td width="100">
                                                <img class="img-responsive shop-cart-img" ng-src="../images/product/{{item.image}}" height="60" />

                                            </td>
                                            <td>{{item.name}}</td>
                                            <td>{{item.price_in| currency:"":0}} ₫</td>
                                            <td style="width: 10%"><input type="number" value="{{item.quantity}}" ng-model="item.quantity"/></td>
                                            <td style="width: 20%">{{item.price_in * item.quantity| currency:"":0}} ₫</td>
                                            <td style="width: 10%">
                                                <button class="btn  btn-danger" ng-click="removeFromCart(item)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>

                            <!--Start cart total-->
                            <div class="col-md-4 col-md-offset-8">
                                <h3>Tổng</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Số lượng mặt hàng</th>
                                            <td>{{carts.length}}</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td>{{ getCartTotal() | currency:"":0}} ₫</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="pull-right " style="margin: 20px">
                                    <div class="btn btn-primary " ng-class="getCartTotal() > 0 ?'' : 'disabled'" ng-click="checkOut()">Thanh toán</div>
                                </div>
                            </div>
                            <!--End cart total-->
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->


    </body>
</html>
