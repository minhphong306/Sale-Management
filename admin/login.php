<?php 
session_start();

if (isset($_SESSION['is_logined'])) {
    header("Location: index.php");
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Đăng nhập - Quản lý bán hàng</title>
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
        
        <script src="angular/service/LoginService.js" type="text/javascript"></script>
        <script src="angular/controller/LoginController.js" type="text/javascript"></script>
        <title>Trang chủ - Quản lý bán hàng</title>

        <?php
        include './partial/header.php';
        ?>
    </head>
    <body ng-app="app">
        <div class="container" ng-controller="loginCtrl">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Đăng nhập vào hệ thống</h3>
                        </div>
                        <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" ng-model="username" placeholder="E-mail"  autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" ng-model="password" placeholder="Password"  type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Ghi nhớ
                                        </label>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <a  class="btn btn-lg btn-success btn-block" ng-click="login()" >Đăng nhập</a>
                                </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
