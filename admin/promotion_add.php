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

        <script src="template/bootstrap-datetimepicker/moment.min.js" type="text/javascript"></script>
        <link href="template/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <script src="template/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="template/bootstrap-datetimepicker/vi.js" type="text/javascript"></script>


        <link href="template/jasny-bootstrap/jasny-bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="template/jasny-bootstrap/jasny-bootstrap.js" type="text/javascript"></script>

        <link href="template/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="template/pnotify/pnotify.custom.min.js" type="text/javascript"></script>

        <!--Angular-->
        <script src="angular/lib/angular.min.js"></script>
        <script src="angular/locale/angular-locale_vi-vn.js" type="text/javascript"></script>
        <script src="angular/module/app.js" type="text/javascript"></script>
        <script src="angular/service/UploadService.js" type="text/javascript"></script>
        <script src="angular/service/GalleryService.js" type="text/javascript"></script>
        <script src="angular/service/ProductService.js" type="text/javascript"></script>
        <script src="angular/service/CategoryService.js" type="text/javascript"></script>
        <script src="angular/service/PromotionService.js" type="text/javascript"></script>
        <script src="angular/service/UnitService.js" type="text/javascript"></script>
        <script src="angular/controller/PromotionController.js" type="text/javascript"></script>

    </head>
    <body ng-controller="addPromotionCtrl">
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
                            <h2 class="page-header">Thêm mới khuyến mại</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">                        
                        <div class="col-md-7">
                            <h3 class="text-center">Chi tiết khuyến mại</h3>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Tên khuyến mại</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Nhập tên khuyến mại" ng-model="current_add_model.name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Loại khuyến mại</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" ng-model="current_add_model.type">
                                            <option  value="1">Theo %</option>
                                            <option  value="2">Theo tiền mặt</option>
                                            <option  value="3">Theo mã giảm giá</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">TG bắt đầu</label>
                                    <div class="col-sm-9">
                                        <div class='input-group date' id="start_time" >
                                            <input  type='text' class="form-control" ng-model="current_add_model.name"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">TG kết thúc</label>
                                    <div class="col-sm-9">
                                        <div class='input-group date' id="end_time" >
                                            <input  type='text' class="form-control" ng-model="current_add_model.name"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>
                    <div class="row" style="margin-bottom: 30px">
                        <button class="btn btn-primary col-md-offset-2" ng-click="addProduct()">
                            Thêm khuyến mại
                        </button>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->





    </body>
</html>
