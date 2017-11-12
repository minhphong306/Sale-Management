<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>24h Mart | Buy more - cheap more</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="library/bootstrap3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="library/bootstrap3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="library/font-awaresome/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="custom/style.css" rel="stylesheet" type="text/css"/>

        <script src="library/jquery/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="library/angular/angular.min.js" type="text/javascript"></script>
        <script src="angular/module/app.js" type="text/javascript"></script>
        <script src="library/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="admin/angular/service/CategoryService.js" type="text/javascript"></script>
        <script src="admin/angular/service/ProductService.js" type="text/javascript"></script>
        <script src="angular/controller/IndexController.js" type="text/javascript"></script>
    </head>
    <body ng-app="app">
        <div ng-controller="indexCtrl">
            <?php
            include './partial/navbar.php';
            ?>

            <!--Slider-->
            <div class="shop-slider">
                <div class="container">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner center" role="listbox" >
                            <div class="item active">
                                <img src="images/banner/1.jpg" alt="..." style="height: 300px">
                                <div class="carousel-caption">
                                    ...
                                </div>
                            </div>
                            <div class="item">
                                <img src="images/banner/2.jpg" alt="..."  style="height: 300px">
                                <div class="carousel-caption">
                                    Picture 1
                                </div>
                            </div>
                            <div class="item">
                                <img src="images/banner/3.jpg" alt="..."  style="height: 300px">
                                <div class="carousel-caption">
                                    Picture 2
                                </div>
                            </div>

                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--End slider-->

            <!--Shop container-->
            <div class="shop-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item disabled">Danh mục</li>
                                    <li ng-repeat="item in parent_categories" class="list-group-item hover">
                                        <a href="category.php?id={{item.id}}">{{item.name}}</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4" ng-repeat="item in products">
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
                                                    <button class="btn  btn-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </button>

                                                    <button ng-click="preprareAddToCart(item)" class="btn  btn-success"  data-toggle="modal" data-target="#myModalAddCart">
                                                        <i class="fa fa-cart-plus"></i>
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <nav class="text-center">
                                        <ul class="pagination">
                                            <li>
                                                <a href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li>
                                                <a href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Container-->
        </div>

        <!--Cart modal-->
        <div class="modal fade" id="myModalAddCart" role="dialog" ng-controller="indexCtrl">
            <div class="modal-dialog">

                <!-- Modal add content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm vào giỏ hàng</h4>
                    </div>
                    <div class="modal-body">
                        <div class="shop-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td width="100">
                                            <img class="img-responsive shop-cart-img" ng-src="images/product/default.jpg" height="60" />
                                            <p class="text-center">{{prepare_item.name}}</p>
                                        </td>
                                        <td>{{item.price| currency:"":0}} ₫</td>
                                        <td style="width: 10%"><input type="number" value="1" ng-model="product_quantity"/></td>
                                        <td style="width: 20%">{{item.price * product_quantity| currency:"":0}} ₫</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addToCart()">
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
        <!--End cart modal-->

        <?php
        require './partial/footer.php';
        ?>

        <script>
            $(document).ready(function () {
            $("#export").click(function () {
            $("#tablerr").table2excel({
            // exclude CSS class
            exclude: ".noExl",
                    name: "Worksheet Name",
                    filename: "SomeFile" //do not include extension
            });
            });
            });
        </script>
    </body>
</html>