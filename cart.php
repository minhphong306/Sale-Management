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
    </head>
    <body>
        <?php
        include './partial/navbar.php';
        ?>

        <h3 class="text-center">Giỏ hàng</h3>

        <!--Start cart-->
        <div class="shop-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--Start cart table-->
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
                                            <img class="img-responsive shop-cart-img" src="images/product/1.jpg" height="60" />
                                            <p class="text-center">Quần đùi</p>
                                        </td>
                                        <td>100.000 đ</td>
                                        <td width="10"><input type="number" value="5"/></td>
                                        <td>500.000 đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--End cart table-->

                        <!--Start cart total-->
                        <div class="col-md-4 col-md-offset-8">
                            <h3>Tổng</h3>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Số lượng mặt hàng</th>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền</th>
                                        <td>500.000 đ</td>
                                    </tr>
                                    <tr>
                                        <th>Giảm giá</th>
                                        <td>100.000 đ</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng thanh toán</th>
                                        <td>400.000 đ</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pull-right">
                                <div class="btn btn-primary">Thanh toán</div>
                            </div>
                        </div>
                        <!--End cart total-->
                    </div>
                </div>
            </div>
        </div>

        <!--End cart-->


        <?php
        require './partial/footer.php';
        ?>
        <script src="library/jquery/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="library/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
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