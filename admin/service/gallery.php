<?php

require '../service/FileUtil.php';
$result = getProductGallery();
echo json_encode($result);

