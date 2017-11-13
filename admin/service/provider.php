<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_provider':
            $data = getProvider();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_provider':
            $name = $_REQUEST['name'];
            $phone = $_REQUEST['phone'];
            $email = $_REQUEST['email'];
            $address = $_REQUEST['address'];
            $note = $_REQUEST['note'];
            addProvider($name, $phone, $email, $address, $note);
            break;

        case 'edit_provider':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $phone = $_REQUEST['phone'];
            $email = $_REQUEST['email'];
            $address = $_REQUEST['address'];
            $note = $_REQUEST['note'];
            editProvider($id, $name, $phone, $email, $address, $note);
            break;

        case 'remove_provider':
            $id = $_REQUEST['id'];
            removeProvider($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);