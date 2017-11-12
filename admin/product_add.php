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
        <link href="template/jasny-bootstrap/jasny-bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="template/jasny-bootstrap/jasny-bootstrap.js" type="text/javascript"></script>
        
        <link href="template/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css"/>
        <script src="template/pnotify/pnotify.custom.min.js" type="text/javascript"></script>

        <!--Angular-->
        <script src="angular/lib/angular.min.js"></script>
        <script src="angular/locale/angular-locale_vi-vn.js" type="text/javascript"></script>
        <script src="angular/module/app.js" type="text/javascript"></script>
        <script src="template/ng-table/ng-table.min.js"></script>
        <link href="template/ng-table/ng-table.min.css" rel="stylesheet" type="text/css">
        <script src="angular/service/UploadService.js" type="text/javascript"></script>
        <script src="angular/service/GalleryService.js" type="text/javascript"></script>
        <script src="angular/service/ProductService.js" type="text/javascript"></script>
        <script src="angular/service/CategoryService.js" type="text/javascript"></script>
        <script src="angular/service/PromotionService.js" type="text/javascript"></script>
        <script src="angular/service/UnitService.js" type="text/javascript"></script>
        <script src="angular/controller/ProductController.js" type="text/javascript"></script>


    </head>
    <body ng-controller="addProductCtrl">
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
                            <h2 class="page-header">Thêm mới sản phẩm</h2>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <div class="row">                        
                        <div class="col-md-7">
                            <h3 class="text-center">Chi tiết sản phẩm</h3>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Tên sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" ng-model="current_add_model.name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Hình ảnh</label>
                                    <div class="col-sm-9">
                                        <button  ng-click="loadGallery()"  class="btn  btn-success"  data-toggle="modal" data-target="#myModalGallery">
                                            <i class="fa fa-picture-o"></i> Thư viện
                                        </button>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-primary btn-file"><span><i class="fa fa-photo"></i> Tải ảnh</span><input type="file" onchange="readURL(this)" file-model="myFile"/></span>
                                            <span class="fileinput-filename"></span><span class="fileinput-new"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Danh mục cha</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" ng-model="selected_parent_category" ng-options="item.name for item in parent_categories" ng-change="getChildCategory()">
                                            <option value="">-- Chọn danh mục cha --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Danh mục con</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" ng-model="selected_category" ng-options="item.name for item in child_categories">
                                            <option value="">-- Chọn danh mục con --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Giá</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="Nhập giá sản phẩm" ng-model="current_add_model.price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Đơn vị tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" ng-model="selected_unit"  ng-options="item.name for item in units">
                                            <!--<option ng-repeat="item in units" value="{{item.id}}">{{item.name}}</option>-->
                                            <option value="">-- Chọn đơn vị --</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">KM áp dụng</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" ng-options="item.name for item in promotions" ng-model="selected_promotion" ng-change="promotionChange()">
                                            <!--<option ng-repeat="item in promotions" value="{{item}}" ng-change="choosePromotion()">{{item.name}}</option>-->
                                            <option value="">-- Chọn khuyến mại --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" ng-if="current_add_model.promotion.type == '1'">
                                    <label class="control-label col-sm-3">Phần trăm</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" placeholder="Nhập giá sản phẩm" ng-model="current_add_model.promotion_value" ng-change="abc()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Mô tả:</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="3" ng-model="current_add_model.description" ></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <h3 class="text-center">Xem trước</h3>
                            <div class = "thumbnail">
                                <center>
                                    <div class = "thumbnail">
                                        <img id="img_thumbnail"  style="width:200px; height: 200px" ng-src = "http://localhost:8081/Sale_Manage/images/product/{{preview_image}}" alt = "{{item.name}}">
                                    </div>
                                </center>
                                <div class="pull-right">
                                    <label  ng-minlength="1" ng-maxlength="2"  class="label label-danger" style="font-size: 100%">SALE {{current_add_model.promotion_value}}%</label>
                                </div>
                                <div class = "caption text-center" >
                                    <h3>{{current_add_model.name}}</h3>
                                    <p>{{current_add_model.description}}</p>
                                    <div ng-if="current_add_model.promotion_value > 0">
                                        <h4 style="text-decoration: line-through"><b>{{current_add_model.price| currency:"":0}} ₫</b></h4>
                                        <h3 class="text-danger"><b>{{current_add_model.price * (1 - current_add_model.promotion_value / 100) | currency:"":0}} ₫</b></h3>
                                    </div>
                                    <div ng-if="current_add_model.promotion_value <= 0">
                                        <h3 class="text-danger"><b>{{current_add_model.price| currency:"":0}} ₫</b></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 30px">
                        <button class="btn btn-primary col-md-offset-2" ng-click="addProduct()">
                            Thêm sản phẩm
                        </button>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Modal gallery -->
        <div class="modal fade" id="myModalGallery" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thư viện ảnh</h4>
                    </div>
                    <div class="modal-body" style="width: 600px; overflow: auto; overflow-x: hidden">
                        <div class="col-md-12" >
                           <div class="col-md-4" ng-repeat="item in galleries" ng-click="imageChange(item)" style="{{item.status == true ? 'outline: solid 5px blue' : ''}}">
                                <div class = "thumbnail">
                                    <img id="img_thumbnail"  ng-src = "http://localhost:8081/Sale_Manage/images/product/{{item.file_name}}" alt = "{{item.file_name}}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="chooseImage()">
                            <i class="fa fa-check"></i>
                            Chọn
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
