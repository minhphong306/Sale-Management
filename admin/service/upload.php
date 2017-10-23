<?php
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Sale_Manage/images/product/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$status = true;
$message = '';

$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $message = "File is an image - " . $check["mime"] . ".";
        $status = true;
    } else {
        $message = "File is not an image.";
        $status = true;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $message = "Sorry, file already exists.";
    $status = false;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $message = "Sorry, your file is too large.";
    $status = false;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $status = false;
}
// Check if $uploadOk is set to 0 by an error
if ($status == false) {
    $message = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        $message = "Sorry, there was an error uploading your file.";
    }
}

$result["status"] = $status;
$result["message"] = $message;
?>