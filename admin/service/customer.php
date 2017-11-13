<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_customer':
            $data = getCustomer();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_customer':
            $name = $_REQUEST['name'];
            $phone = $_REQUEST['phone'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $address = $_REQUEST['address'];
            $facebook = $_REQUEST['facebook'];
            $note = $_REQUEST['note'];
            addCustomer($name, $phone, $email, $password, $address, $facebook, $note);
            break;

        case 'edit_customer':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $phone = $_REQUEST['phone'];
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $address = $_REQUEST['address'];
            $facebook = $_REQUEST['facebook'];
            $note = $_REQUEST['note'];
            editCustomer($id, $name, $phone, $email, $password, $address, $facebook, $note);
            break;

        case 'remove_customer':
            $id = $_REQUEST['id'];
            removeCustomer($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
