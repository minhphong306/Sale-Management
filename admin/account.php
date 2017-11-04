<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tài khoản - Quản lý bán hàng</title>
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
        <script src="angular/service/AccountService.js" type="text/javascript"></script>
        <script src="angular/controller/AccountController.js" type="text/javascript"></script>
        
        
    </head>
    <body ng-controller="accountCtrl">
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
                            <h1 class="page-header">Tài khoản</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div>
                            <btn class="btn  btn-success"  data-toggle="modal" data-target="#myModalAdd">
                                <i class="fa fa-plus"></i> Thêm mới
                            </btn>
                        </div>
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã TK</th>
                                    <th>Mã NV</th>
                                    <th>Tên NV</th>
                                    <th>Tên TK</th>
                                    <th>Mật khẩu</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in accounts" ng-if="item.is_deleted != 1">
                                    <td>{{$index + 1}}</td>
                                    <td>{{item.id}}</td>
                                    <td>{{item.staff_id}}</td>
                                    <td>{{item.staff_name}}</td>
                                    <td>{{item.username}}</td>
                                    <td>{{item.password}}</td>
                                    <td>{{item.is_active == 0 ? 'Khóa' : 'Hoạt động'}}</td>
                                    <td>{{item.note}}</td>
                                    <td>
                                        <button  ng-click="load_edit_account(item)"  class="btn btn-circle btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button ng-click="load_remove_account(item)" class="btn btn-circle btn-danger"  data-toggle="modal" data-target="#myModalRemove">
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
                        <h4 class="modal-title">Thêm tài khoản</h4>
                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên tài khoản</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên tài khoản" ng-model="current_add_model.name">
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
                        <button type="button" class="btn btn-success" ng-click="addAccount()">
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
                        <h4 class="modal-title">Sửa tài khoản {{current_edit_model.name}}</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên tài khoản</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên tài khoản" ng-model="current_edit_model.name">
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
                        <button type="button" class="btn btn-success" ng-click="editAccount()" >Lưu</button>
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
                        <span>Bạn có muốn xóa tài khoản </span><h4> {{current_remove_model.name}}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="removeAccount()">Xóa</button>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
