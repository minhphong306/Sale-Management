<?php

require './DBUntil.php';
session_start();
$account = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


$is_success = login($account, $password);
$result['status'] = $is_success;
if($is_success){
    $_SESSION['is_logined'] = true;
}

echo json_encode($result);
?>