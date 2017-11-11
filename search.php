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
    <body ng-app="app">
        <div ng-controller="indexCtrl">
            <?php
            include './partial/navbar.php';
            ?>

            
        </div>


        <?php
        require './partial/footer.php';
        ?>
        <script src="library/jquery/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="library/angular/angular.min.js" type="text/javascript"></script>
        <script src="angular/module/app.js" type="text/javascript"></script>
        <script src="library/bootstrap3/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="admin/angular/service/CategoryService.js" type="text/javascript"></script>
        <script src="admin/angular/service/ProductService.js" type="text/javascript"></script>
        <script src="angular/controller/IndexController.js" type="text/javascript"></script>
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