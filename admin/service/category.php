<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_category':
            $data = getCategory();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_category':

            break;

        case 'edit_category':

            break;

        case 'remove_category':

            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
