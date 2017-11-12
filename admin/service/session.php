<?php

session_start();
$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'get_product':
            if (isset($_SESSION['cart'])) {
                $data = $_SESSION['cart'];
            } else {
                $data = [];
            }
            $result['data'] = $data;
            break;
        case 'add_product':
            // get infomation
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $description = $_REQUEST['description'];
            $price = $_REQUEST['price'];
            $image = $_REQUEST['image'];
            $quantity = $_REQUEST['quantity'];

            // Add to session
            $product['id'] = $id;
            $product['name'] = $name;
            $product['description'] = $description;
            $product['price'] = $price;
            $product['image'] = $image;
            $product['quantity'] = $quantity;

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check product already exist in cart
            $_SESSION['cart'][] = $product;
            $result['status'] = true;
            break;
        case 'remove_product':
            // get infomation
            $id = $_REQUEST['id'];
            $products = $_SESSION['cart'];
            
            foreach ($products as $product_key => $product) {
                if($product['id'] == $id){
                    unset($products[$product_key]);
                    break;
                }
            }
            $_SESSION['cart'] = $products;
            break;

        case 'putchase':
            break;
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
