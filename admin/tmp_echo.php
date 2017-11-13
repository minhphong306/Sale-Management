<?php

$data = $_REQUEST['data'];
foreach ($data as $product) {
    echo $product['name'];
}


//require './service/DBUntil.php';
//require './service/FileUtil.php';
//session_start();
//$account = 'phongdm';
//$password = '123';
//$login_result = login($account, $password);
//$result['status'] = $login_result['count'] > 0 ? true : false;
//echo var_dump(json_encode($_SESSION));
?>
<!--<script src="angular/lib/angular.min.js"></script>
<script src="angular/lib/ng-table.min.js" type="text/javascript"></script>  
<script src="angular/module/app.js" type="text/javascript"></script>
<body ng-app="app">
    <div ng-controller="myCtrl">
        <div class="file-upload">
            <input type="text" ng-model="name">
            <input type="file" file-model="myFile"/>
            <button ng-click="uploadFile()">upload me</button>
        </div>
    </div>

</body>-->

<?php

//echo var_dump(getProductGallery());
//$directory =  $_SERVER['DOCUMENT_ROOT'] . "/Sale_Manage/images/";   
//
//$images = glob($directory . "*.jpg");
//
//foreach($images as $image)
//{
//  echo $image;
//}
//if (is_dir($directory)) {
//    if ($dh = opendir($directory)) {
//        $images = array();
//
//        while (($file = readdir($dh)) !== false) {
//            if (!is_dir($directory.$file)) {
//                $images[] = $file;
//            }
//        }
//
//        closedir($dh);
//
//        print_r($images);
//    }
//}
//$arr = scandir();
//$test = chdir($_SERVER['DOCUMENT_ROOT']);
//echo $test;
//$path = get_include_path(); // get the current path
//$oldcwd = getcwd(); // get the current path
//
//// change to outside of the document root
//chdir($_SERVER['DOCUMENT_ROOT'] . "/Sale_Manage"); 
//$newcwd = getcwd(); // get the new working directory
//echo $newcwd;
//
//
//echo var_dump($arr);
//$name = "Do Minh Phong";
//$phone = "0962275964";
//$email = "phong@gmail.com";
//$address = "HN";
//$facebook = "dominhphong.18";
//$note = "Khach quen";
//$id = "1";
//
//echo var_dump(addCustomer($name, $phone, $email, $address, $facebook, $note));
//echo var_dump(getProduct());
//$name = "haha";
//$note = "hihi";
//echo addCategory($name, $note);
//$arr = [];
//
//$nv1 =  ["name" => "Phong",
//         "age" => "12"];
//
//$nv2 =  ["name" => "Phong",
//         "age" => "12"];
//
//$nv3 =  ["name" => "Phong",
//         "age" => "12"];
//
//$arr[] = $nv1;
//$arr[] = $nv2;
//$arr[] = $nv3;
//$arr[] = $nv3;
//$arr[] = $nv3;
//$arr[] = $nv3;
//$arr[] = $nv3;
//$arr[] = $nv3;
//
//echo json_encode($arr);
?>

<!--
<!DOCTYPE html>
<html>
    <body>
        <form action="service/upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form>

    </body>
</html>-->