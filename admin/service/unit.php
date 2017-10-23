<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_unit':
            $data = getUnit();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_unit':
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            addUnit($name, $note);
            break;

        case 'edit_unit':
            $id = $_REQUEST['id']; 
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            editUnit($id, $name, $note);
            break;

        case 'remove_unit':
            $id = $_REQUEST['id'];
            removeUnit($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
