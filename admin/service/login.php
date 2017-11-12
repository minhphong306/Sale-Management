<?php

require './DBUntil.php';

session_start();
$account = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


$login_result = login($account, $password);
$result['status'] = $login_result['count'] > 0 ? true : false;
if($result['status']){
    $data = $login_result['data'];
    $_SESSION['is_logined'] = true;
    $_SESSION['staff_name'] = $data['staff_name'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['staff_id'] = $data['staff_id'];
    $_SESSION['account_id'] = $data['account_id'];
    $_SESSION['test arr'] = $data;
    
}

echo json_encode($result);
?>