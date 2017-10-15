<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Nhân viên - Quản lý bán hàng</title>

        <?php
        include './partial/header.php';
        ?>
    </head>
    <body>
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
                            <h1 class="page-header">Nhân viên</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <button onclick="getData()">Lay dl</button>
                    </div>
                    <div class="row">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody id="bodyData">

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <script>
            function getData() {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // lấy dữ liệu về, parse sang obj
                        var arr = JSON.parse(this.responseText);

                        // tạo 1 biến html là nội dung body
                        var HTML = '';


                        // Chạy vòng lặp trong đối tượng, cộng dồn vào HTML
                        for (var i = 0; i < arr.length; i++) {
                            HTML += "<tr>";
                            HTML += "<td>";
                            HTML += arr[i].name;
                            HTML += "</td>";

                            HTML += "<td>";
                            HTML += arr[i].age;
                            HTML += "</td>";
                            HTML += "</tr>";
                        }


                        // getElemtbyID, gán vào table body
                        document.getElementById("bodyData").innerHTML = HTML;
                    }
                };

                request.open("GET", "tmp_echo.php", true);
                request.send();
            }
        </script>
    </body>
</html>
