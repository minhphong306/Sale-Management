<?php

$mode = $_POST['mode'] ?? '';

$result = [];

if ($mode != '') {
    $result = [];
    switch ($mode) {
        case 'add_product':
            
            break;
       
    }
} else {
    $result['status'] = 'not_found';
}

echo json_encode($result);
