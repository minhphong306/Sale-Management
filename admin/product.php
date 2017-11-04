<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Sản phẩm - Quản lý bán hàng</title>
        <?php
        include './partial/header.php';
        ?>
        <link href="template/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="template/pnotify/pnotify.custom.min.js" type="text/javascript"></script>
        <!--Angular-->
        <script src="angular/lib/angular.min.js"></script>
        <script src="angular/locale/angular-locale_vi-vn.js" type="text/javascript"></script>
        <script src="angular/module/app.js" type="text/javascript"></script>
        <script src="template/ng-table/ng-table.min.js"></script>
        <link href="template/ng-table/ng-table.min.css" rel="stylesheet" type="text/css">
        <script src="angular/service/ProductService.js" type="text/javascript"></script>
        <script src="angular/service/CategoryService.js" type="text/javascript"></script>
        <script src="angular/service/PromotionService.js" type="text/javascript"></script>
        <script src="angular/service/UnitService.js" type="text/javascript"></script>
        <script src="angular/controller/ProductController.js" type="text/javascript"></script>


    </head>
    <body ng-controller="productCtrl">
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
                            <h1 class="page-header">Sản phẩm</h1>
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

                        <div class="pull-right">
                            <div class="btn btn-info" ng-click="change_display_mode('grid')"><i class="fa fa-th"></i></div>
                            <div class="btn btn-danger"  ng-click="change_display_mode('table')"><i class="fa fa-table"></i></div>
                        </div>
                        <br/>
                        <br/>
                        <div class="row" ng-if="display_mode == 'grid'">
                            <div class="col-md-3" ng-repeat="item in products">
                                <div class = "thumbnail">
                                    <center>
                                        <div class = "thumbnail">
                                            <img  style="width:200px; height: 200px" ng-src = "http://localhost:8081/Sale_Manage/images/product/{{item.image}}" alt = "{{item.name}}">
                                        </div>
                                    </center>
                                    <div class="pull-right">
                                        <label class="label label-danger" style="font-size: 100%">SALE {{item.promotion_value}}%</label>
                                    </div>
                                    <div class = "caption text-center" >
                                        <h3>{{item.name}}</h3>
                                        <p>{{item.description}}</p>
                                        <p class="text-danger"><b>{{item.price| currency:"":0}} ₫</b></p>
                                        <p>
                                            <button  ng-click="load_edit_product(item)"  class="btn  btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            <button ng-click="load_remove_product(item)" class="btn  btn-danger"  data-toggle="modal" data-target="#myModalRemove">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" ng-if="display_mode == 'table'">
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
                                        <td>{{item.unit_name}}</td>
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
                        <h4 class="modal-title">Thêm sản phẩm</h4>
                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" ng-model="current_add_model.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Danh mục</label>
                                <div class="col-sm-9">
                                    <select class="form-control" ng-model="selected_category">
                                        <option ng-repeat="item in categories" value="{{item.id}}">{{item.name}}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Giá</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" ng-model="current_add_model.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Đơn vị tính</label>
                                <div class="col-sm-9">
                                    <select class="form-control" ng-model="selected_category">
                                        <option ng-repeat="item in categories" value="{{item.id}}">{{item.name}}</option>

                                    </select>
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

        <!-- Modal edit -->
        <div class="modal fade" id="myModalEdit" role="dialog">
            <div class="modal-dialog">

                <!-- Modal edit content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sửa sản phẩm {{current_edit_model.name}}</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" ng-model="current_edit_model.name">
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
                        <button type="button" class="btn btn-success" ng-click="editCategory()" >Lưu</button>
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
                        <span>Bạn có muốn xóa sản phẩm </span><h4> {{current_remove_model.name}}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="removeCategory()">Xóa</button>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
