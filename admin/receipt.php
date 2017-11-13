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
                        <button type="button"  ng-click="test()">dddddddd</button>
                        <div style="margin: 20px">
                            <btn class="btn  btn-success"  data-toggle="modal" data-target="#myModalAdd" ng-click="reset_add_model()">
                                <i class="fa fa-plus"></i> Thêm mới
                            </btn>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <p>Tiêu chí SX: {{ receiptSortType}}</p>
                                <p>Xếp theo   : {{ receiptSortReverse == true ? 'A -> Z' : 'Z -> A'}}</p>
                                <p>DL tìm kiếm: {{ receiptSortSearchQuery}}</p>
                            </div>
                            <form>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                        <input type="text" class="form-control" placeholder="Nhập dữ liệu cần tìm kiếm" ng-model="receiptSortSearchQuery">
                                    </div>      
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6" style="padding-top: 40px">

                        </div>

                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <!--<th>Mã đơn vị</th>-->
                                    <th ng-click="receiptSortType = 'name'; receiptSortReverse = !receiptSortReverse">
                                        <a href=""> Tên đơn vị </a>
                                        <span ng-show="receiptSortType == 'name' && !receiptSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="receiptSortType == 'name' && receiptSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th style="width: 40%" ng-click="receiptSortType = 'note'; receiptSortReverse = !receiptSortReverse">
                                        <a href=""> Ghi chú </a>
                                        <span ng-show="receiptSortType == 'note' && !receiptSortReverse" class="fa fa-sort-alpha-asc"></span>
                                        <span ng-show="receiptSortType == 'note' && receiptSortReverse" class="fa fa-sort-alpha-desc"></span>
                                    </th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in receipts| orderBy:receiptSortType:receiptSortReverse | filter:receiptSortSearchQuery" ng-if="item.is_deleted != 1">
                                    <td>{{$index + 1}}</td>
                                    <!--<td>DV00{{item.id}}</td>-->
                                    <td>{{item.name}}</td>
                                    <td>{{item.note}}</td>
                                    <td>
                                        <button  ng-click="load_edit_receipt(item)"  class="btn btn-circle btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button ng-click="load_remove_receipt(item)" class="btn btn-circle btn-danger"  data-toggle="modal" data-target="#myModalRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <!-- Modal add -->
        <div class="modal fade" id="myModalAdd" role="dialog">
            <div class="modal-dialog">

                <!-- Modal add content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm danh mục</h4>
                    </div>
                    
                    <div class="modal-body">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Đơn giá</th>
                                    <th>Đơn vị tính</th>
                                    <th style="width: 40%">Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in products" ng-if="item.is_deleted != 1">
                                    <td>{{$index + 1}}</td>
                                    <td>SP00{{item.id}}</td>
                                    <td>{{item.name}}</td>
                                    <td>{{item.category_name}}</td>
                                    <td>{{item.price| currency:"":0}} ₫</td>
                                    <td>{{item.receipt_name}}</td>
                                    <td>{{item.note}}</td>
                                    <td>
                                        <button  ng-click="load_edit_product(item)"  class="btn btn-circle btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button ng-click="load_remove_product(item)" class="btn btn-circle btn-danger"  data-toggle="modal" data-target="#myModalRemove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addCategory()">
                            <i class="fa fa-check"></i>
                            Thêm
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            <i class="fa fa-ban"></i>
                            Hủy
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
