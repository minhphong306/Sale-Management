<?php

require './DBUntil.php';
$mode = $_POST['mode'] ?? '';
session_start();

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'checkout_order_in':
            $staff_id = $_SESSION['staff_id'];
            $note = $_REQUEST['note'];
            $provider_id = $_REQUEST['provider_id'];
            $data = $_REQUEST['data'];
            $total = $_REQUEST['total'];
            
           $result =  addOrderIn($staff_id, $provider_id,$total, $note);
           $orderin_id = $result['order_in_id'];
           foreach ($data as $product) {
               $product_id = $product['id'];
               $product_quantity = $product['quantity'];
               $product_price = $product['price_in'];
               $note = "";
               
               addOrderInDetail($orderin_id, $product_id, $product_quantity, $product_price, $note);
           }
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
