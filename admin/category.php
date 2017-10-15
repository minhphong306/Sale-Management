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
                        <table ng-table="categoryTable" class="table table-hover" >
                            <tr ng-repeat="user in data">
                                <td title="'Name'" sortable="'name'">
                                    {{user.name}}</td>
                                <td title="'Note'" sortable="'note'">
                                    {{user.note}}</td>
                                <td title="'Action'">
                                    <button  ng-click="load_edit_room(item)"  class="btn btn-warning"  data-toggle="modal" data-target="#myModalEdit" >
                                        <i class="fa fa-pencil"></i> Sửa
                                    </button>
                                    <button ng-click="load_remove_room(item)" class="btn btn-danger"  data-toggle="modal" data-target="#myModalRemove">
                                        <i class="fa fa-trash"></i> Xóa
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
    </body>
</html>
