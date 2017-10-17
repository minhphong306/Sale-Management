<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_product':
            $data = getProduct();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_product':
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            addProduct($name, $note);
            break;

        case 'edit_product':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            editProduct($id, $name, $note);
            break;

        case 'remove_product':
            $id = $_REQUEST['id'];
            removeProduct($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
