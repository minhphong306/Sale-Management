<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_promotion':
            $data = getPromotion();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'get_active_promotion':
            $data = getActivePromotion();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_promotion':
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            addPromotion($name, $note);
            break;

        case 'edit_promotion':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            editPromotion($id, $name, $note);
            break;

        case 'remove_promotion':
            $id = $_REQUEST['id'];
            removePromotion($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
