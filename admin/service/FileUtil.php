<?php

function getProductGallery() {
    $images = [];
    
    $image_directory = $_SERVER['DOCUMENT_ROOT'] . "/Sale_Manage/images/product";
    if (is_dir($image_directory)) {
        if ($dir_handle = opendir($image_directory)) {
            while (($file = readdir($dir_handle)) !== false) {
                if (!is_dir($image_directory . $file)) {
                    $obj["file_name"] = $file;
                    $obj["status"] = false;
                    $images[] = $obj;
                }
            }
            closedir($dir_handle);
        }
    }
    return $images;
    
}
