<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Khách hàng - Quản lý bán hàng</title>

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
        <script src="angular/service/CustomerService.js" type="text/javascript"></script>
        <script src="angular/controller/CustomerController.js" type="text/javascript"></script>
    </head>
    <body ng-controller="customerCtrl">
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
                            <h1 class="page-header">Khách hàng</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div style="margin: 20px">
                            <btn class="btn  btn-success"  data-toggle="modal" data-target="#myModalAdd" ng-click="reset_add_model()">
                                <i class="fa fa-plus"></i> Thêm mới
                            </btn>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info">
                                <p>Tiêu chí SX: {{ customerSortType}}</p>
                                <p>Xếp theo   : {{ customerSortReverse == true ? 'A -> Z' : 'Z -> A'}}</p>
                                <p>DL tìm kiếm: {{ customerSortSearchQuery}}</p>
                            </div>
                            <form>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                        <input type="text" class="form-control" placeholder="Nhập dữ liệu cần tìm kiếm" ng-model="customerSortSearchQuery">
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
                                    <!--<th>Mã khách hàng</th>-->
                                    <th ng-click="customerSortType = 'name'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Tên khách hàng </a>
                                        <span ng-show="customerSortType == 'name' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'name' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'phone'; customerSortReverse = !customerSortReverse">
                                        <a href=""> SDT </a>
                                        <span ng-show="customerSortType == 'phone' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'phone' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'email'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Email </a>
                                        <span ng-show="customerSortType == 'email' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'email' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'password'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Password </a>
                                        <span ng-show="customerSortType == 'password' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'password' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'address'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Địa chỉ</a>
                                        <span ng-show="customerSortType == 'address' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'address' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'facebook'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Facebook </a>
                                        <span ng-show="customerSortType == 'facebook' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'facebook' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'total_order'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Tổng số hóa đơn </a>
                                        <span ng-show="customerSortType == 'total_order' && !customerSortReverse" class="fa fa-caret-down"></span>
                                        <span ng-show="customerSortType == 'total_order' && customerSortReverse" class="fa fa-caret-up"></span>
                                    </th>
                                    <th ng-click="customerSortType = 'note'; customerSortReverse = !customerSortReverse">
                                        <a href=""> Ghi chú </a>
                                        <span ng-show="customerSortType == 'note' && !customerSortReverse" class="fa fa-sort-alpha-asc"></span>
                                        <span ng-show="customerSortType == 'note' && customerSortReverse" class="fa fa-sort-alpha-desc"></span>
                                    </th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in customers| orderBy:customerSortType:customerSortReverse | filter:customerSortSearchQuery" ng-if="item.is_deleted != 1">
                                    <td>{{$index + 1}}</td>
                                    <!--<td>DV00{{item.id}}</td>-->
                                    <td>{{item.name}}</td>
                                    <td>{{item.phone}}</td>
                                    <td>{{item.email}}</td>
                                    <td>{{item.password}}</td>
                                    <td>{{item.address}}</td>
                                    <td><a target="_blank" href="https://fb.com/{{item.facebook}}">{{item.facebook}}</a></td>
                                    <td>{{item.total_order}}</td>
                                    <td>{{item.note}}</td>
                                    <td>
                                        <button  ng-click="load_edit_customer(item)"  class="btn btn-circle btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button ng-click="load_remove_customer(item)" class="btn btn-circle btn-danger"  data-toggle="modal" data-target="#myModalRemove">
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
                        <h4 class="modal-title">Thêm khách hàng</h4>
                    </div>
                    <div class="modal-body">
                        <h3 ng-if="is_error" class="text-danger bg-danger text-center">{{error_message}}</h3>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên khách hàng</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên khách hàng" ng-model="current_add_model.name" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">SDT</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập SDT khách hàng" ng-model="current_add_model.phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập email khách hàng" ng-model="current_add_model.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập password khách hàng" ng-model="current_add_model.password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập địa chỉ khách hàng" ng-model="current_add_model.address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Facebook</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập facebook khách hàng" ng-model="current_add_model.facebook">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Ghi chú:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" ng-model="current_add_model.note" ></textarea>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addCustomer()">
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

        <!-- Modal edit -->
        <div class="modal fade" id="myModalEdit" role="dialog">
            <div class="modal-dialog">

                <!-- Modal edit content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sửa khách hàng </h4>
                    </div>
                    <div class="modal-body">
                        <h3 ng-if="is_error" class="text-danger bg-danger text-center">{{error_message}}</h3>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên khách hàng</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên khách hàng" ng-model="current_edit_model.name" autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">SDT</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập SDT khách hàng" ng-model="current_edit_model.phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập email khách hàng" ng-model="current_edit_model.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập password khách hàng" ng-model="current_edit_model.password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập địa chỉ khách hàng" ng-model="current_edit_model.address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Facebook</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập facebook khách hàng" ng-model="current_edit_model.facebook">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Ghi chú:</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" ng-model="current_edit_model.note" ></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="editCustomer()" >Lưu</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal remove -->
        <div class="modal fade" id="myModalRemove" role="dialog">
            <div class="modal-dialog">

                <!-- Modal remove content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Xác nhận xóa</h4>
                    </div>
                    <div class="modal-body">
                        <span>Bạn có muốn xóa khách hàng </span><h4> {{current_remove_model.name}}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="removeCustomer()">Xóa</button>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
