<?php

     $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Sale_Manage/images/product/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

     
?>