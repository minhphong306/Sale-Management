<!DOCTYPE html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Danh mục - Quản lý bán hàng</title>
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
        <script src="angular/service/CategoryService.js" type="text/javascript"></script>
        <script src="angular/controller/CategoryController.js" type="text/javascript"></script>


    </head>
    <body ng-controller="categoryCtrl">
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
                            <h1 class="page-header">Danh mục sản phẩm</h1>
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
                        
                        <center ng-if="is_loading">
                            <img src="../images/ajax-loader.gif"/>
                        </center>
                        
                        <div class="table-detail" ng-if="!is_loading">
                            <!--Start parent category-->
                            <div class="col-md-6">
                                <h3 class="text-center text-danger">Danh mục cha</h3>
                                <div class="alert alert-info">
                                    <p>Tiêu chí SX: {{ parentCategorySortType}}</p>
                                    <p>Xếp theo   : {{ parentCategorySortReverse == true ? 'A -> Z' : 'Z -> A'}}</p>
                                    <p>DL tìm kiếm: {{ parentCategorySortSearchQuery}}</p>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                            <input type="text" class="form-control" placeholder="Nhập dữ liệu cần tìm kiếm" ng-model="parentCategorySortSearchQuery">
                                        </div>      
                                    </div>
                                </form>
                                <table class="table table-bordered table-hover" style=" cursor: pointer; ">
                                    <thead>
                                        <tr>
                                            <th><a href="#">#</a></th>
                                            <!--<th>Mã danh mục</th>-->
                                            <th><a href="" ng-click="parentCategorySortType = 'name'; parentCategorySortReverse = !parentCategorySortReverse">
                                                    Tên danh mục
                                                    <span ng-show="parentCategorySortType == 'name' && !parentCategorySortReverse" class="fa fa-caret-down"></span>
                                                    <span ng-show="parentCategorySortType == 'name' && parentCategorySortReverse" class="fa fa-caret-up"></span>
                                                </a></th>
                                            <th style="width: 40%"><a href="" ng-click="parentCategorySortType = 'note'; parentCategorySortReverse = !parentCategorySortReverse">
                                                    Ghi chú
                                                    <span ng-show="parentCategorySortType == 'note' && !parentCategorySortReverse" class="fa fa-caret-down"></span>
                                                    <span ng-show="parentCategorySortType == 'note' && parentCategorySortReverse" class="fa fa-caret-up"></span>
                                                </a></th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in parent_categories | orderBy:parentCategorySortType:parentCategorySortReverse | filter:parentCategorySortSearchQuery" ng-if="item.is_deleted != 1" ng-click="getChildCategory(item.id)">
                                            <td>{{$index + 1}}</td>
                                            <!--<td>{{item.id}}</td>-->
                                            <td>{{item.name}}</td>
                                            <td>{{item.note}}</td>
                                            <td>
                                                <button  ng-click="load_edit_category(item)"  class="btn btn-circle btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button ng-click="load_remove_category(item)" class="btn btn-circle btn-danger"  data-toggle="modal" data-target="#myModalRemove">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!--End parent category-->

                            <!--Start child category-->
                            <div class="col-md-6">
                                <h3 class="text-center text-danger">Danh mục con</h3>
                                <div class="alert alert-info">
                                    <p>Tiêu chí SX: {{ childCategorySortType}}</p>
                                    <p>Xếp theo   : {{ childCategorySortReverse == true ? 'A -> Z' : 'Z -> A'}}</p>
                                    <p>DL tìm kiếm: {{ childCategorySortSearchQuery}}</p>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                            <input type="text" class="form-control" placeholder="Nhập dữ liệu cần tìm kiếm" ng-model="childCategorySortSearchQuery">
                                        </div>      
                                    </div>
                                </form>
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th><a href="#">#</a></th>
                                            <!--<th>Mã danh mục</th>-->
                                            <th><a href="" ng-click="childCategorySortType = 'name'; childCategorySortReverse = !childCategorySortReverse">
                                                    Tên danh mục
                                                    <span ng-show="childCategorySortType == 'name' && !childCategorySortReverse" class="fa fa-caret-down"></span>
                                                    <span ng-show="childCategorySortType == 'name' && childCategorySortReverse" class="fa fa-caret-up"></span>
                                                </a></th>
                                            <th style="width: 40%"><a href="" ng-click="childCategorySortType = 'note'; childCategorySortReverse = !childCategorySortReverse">
                                                    Ghi chú
                                                    <span ng-show="childCategorySortType == 'note' && !childCategorySortReverse" class="fa fa-caret-down"></span>
                                                    <span ng-show="childCategorySortType == 'note' && childCategorySortReverse" class="fa fa-caret-up"></span>
                                                </a></th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in categories | orderBy:childCategorySortType:childCategorySortReverse | filter:childCategorySortSearchQuery" ng-if="item.is_deleted != 1">
                                            <td>{{$index + 1}}</td>
                                            <!--<td>{{item.id}}</td>-->
                                            <td>{{item.name}}</td>
                                            <td>{{item.note}}</td>
                                            <td>
                                                <button  ng-click="load_edit_category(item)"  class="btn btn-circle btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                                    <i class="fa fa-pencil" data-toggle="tooltip" title="Sửa"></i>
                                                </button>
                                                <button ng-click="load_remove_category(item)" class="btn btn-circle btn-danger"  data-toggle="modal" data-target="#myModalRemove">
                                                    <i class="fa fa-trash" data-toggle="tooltip" title="Xóa"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--End child category-->

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
                        <h4 class="modal-title">Thêm danh mục</h4>
                    </div>
                    <div class="modal-body">
                        <h3 ng-if="is_error" class="text-danger bg-danger text-center">{{error_message}}</h3>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục" ng-model="current_add_model.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Loại danh mục</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline"><input type="radio" ng-model="category_type" value="-1" checked>Danh mục cha</label>
                                    <label class="radio-inline"><input type="radio" ng-model="category_type" value="0">Danh mục con</label>
                                </div>
                            </div>
                            <div class="form-group" ng-show="category_type == 0">
                                <label class="control-label col-sm-3">Danh mục cha</label>
                                <div class="col-sm-9">
                                    <select class="form-control" ng-model="selected_parent">
                                        <option ng-repeat="item in parent_categories" value="{{item.id}}">{{item.name}}</option>

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
                        <h4 class="modal-title">Sửa danh mục</h4>
                    </div>
                    <div class="modal-body">
                        <h3 ng-if="is_error" class="text-danger bg-danger text-center">{{error_message}}</h3>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục" ng-model="current_edit_model.name">
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
                        <span>Bạn có muốn xóa danh mục </span><h4> {{current_remove_model.name}}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="removeCategory()">Xóa</button>
                    </div>
                </div>

            </div>
        </div>

    </body>
</html>
