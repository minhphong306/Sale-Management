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
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            addCategory($name, $note);
            break;

        case 'edit_category':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            editCategory($id, $name, $note);
            break;

        case 'remove_category':
            $id = $_REQUEST['id'];
            removeCategory($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
