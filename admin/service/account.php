<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_account':
            $data = getAccount();
            $result['data'] = $data;
            $result['status'] = 'success';
            break;
        case 'add_account':
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            addAccount($name, $note);
            break;

        case 'edit_account':
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $note = $_REQUEST['note'];
            editAccount($id, $name, $note);
            break;

        case 'remove_account':
            $id = $_REQUEST['id'];
            removeAccount($id);
            break;
        default:
            $result['status'] = 'not_found';
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
