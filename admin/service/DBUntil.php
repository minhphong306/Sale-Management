<?php

function getConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "PhongDP25#*";
    $dbname = "online_shopping";
    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
}

// <editor-fold defaultstate="collapsed" desc="Category">
function getCategory() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT id, name, note, is_deleted FROM category where parent_id != -1 order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function getParentCategory() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `note`, `is_deleted` FROM `category` WHERE parent_id = -1";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getChildCategory($parent_id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `note`, `is_deleted` FROM `category` WHERE parent_id = $parent_id";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addCategory($name, $parent_id, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO category (name, parent_id, note) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $parent_id, $note);

    $result = $stmt->execute();
    return $result;
}

function editCategory($id, $name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `category` 
                            SET 
                                `name`= ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $name, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeCategory($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `category` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Product">
function getProduct() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT 
            p.id, p.cat_id, c.name as cat_name,
            p.unit_id, u.name as unit_name,
            p.name, p.description,
            p.price_in, p.price_out, pmd.promotion_value,
            pm.type as promotion_type, pm.name as promotion_name,
            p.image, p.is_deleted
            FROM product p
                join unit u on p.unit_id = u.id
                join category c on p.cat_id = c.id
                left join promotion_detail pmd on p.id = pmd.product_id
                left join promotion pm on pm.id = pmd.id
            ";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addProduct($cat_id, $unit_id, $name, $description, $price, $image) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO `product`
                            (cat_id, unit_id, name,
                             description, price, image)
                             VALUES 
                             (?, ?, ?,
                             ?, ?, ?)");
    $stmt->bind_param("ssssds", $cat_id, $unit_id, $name, $description, $price, $image);

    $result = $stmt->execute();
    return $result;
}

function editProduct($id, $cat_id, $unit_id, $name, $description, $price, $image) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `product` SET
                            `cat_id`= ? ,`unit_id`=?,
                            `name`=?,`description`=?,
                            `price`= ?,`image`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $cat_id, $unit_id, $name, $description, $price, $image, $id);

    $result = $stmt->execute();
    return $result;
}

function removeProduct($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `product` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Unit">
function getUnit() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT id, name, note, is_deleted FROM unit where is_deleted = 0 order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addUnit($name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO unit (name, note) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $note);

    $result = $stmt->execute();
    return $result;
}

function editUnit($id, $name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `unit` 
                            SET 
                                `name`= ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $name, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeUnit($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `unit` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Customer">
function getCustomer() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT c.`id`, c.`name`, c.`phone`, c.`email`, c.password,  c.`address`, c.`facebook`, count(o.id) as total_order,  c.`note`, c.`is_deleted` 
        FROM `customer` c left join order_out o
	on o.customer_id = c.id 
        GROUP BY
                c.id
        order by
                name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addCustomer($name, $phone, $email, $password, $address, $facebook, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO `customer` 
                            (`name`, `phone`, `email`,
                            `address`, `facebook`, `note`, `password`) 
                             VALUES 
                             (?, ?, ?,
                             ?, ?, ?,
                             ?)");
    $stmt->bind_param("sssssss", $name, $phone, $email, $address, $facebook, $note, $password);

    $result = $stmt->execute();
    return $result;
}

function editCustomer($id, $name, $phone, $email, $password, $address, $facebook, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `customer`
                        SET 
                            `name`=?, `phone`= ?,
                            `email`=?, `address`=?,
                            `facebook`= ?,`note`=?,
                            `password` = ? 
                        WHERE `id` = ?");
    $stmt->bind_param("ssssssss", $name, $phone, $email, $address, $facebook, $note, $password, $id);

    $result = $stmt->execute();
    return $result;
}

function removeCustomer($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `customer` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Promotion">
function getPromotion() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `type`, `start_time`, `end_time`, `note`, `is_deleted` FROM `promotion`";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getActivePromotion() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT `id`, `name`, `type`, `start_time`, `end_time`, `note`, `is_deleted` FROM `promotion`
            where now() > start_time && now() < end_time";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addPromotion($name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO `promotion`
                            (`name`, `type`, 
                            `start_time`, `end_time`,
                             `note`, `is_deleted`)
                             VALUES
                             (?, ?,
                             ?, ?,
                             ?, ?)");
    $stmt->bind_param("ss", $name, $note);

    $result = $stmt->execute();
    return $result;
}

function editPromotion($id, $name, $type, $start_time, $end_time, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `promotion`
                            SET
                                `name`= ?, `type`= ?, 
                                `start_time`= ?, `end_time`= ?,
                                `note`= ?
                            WHERE
                                `id` = ?");
    $stmt->bind_param("ssssss", $name, $type, $start_time, $end_time, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removePromotion($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `promotion` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Account">
function getAccount() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT 
                        a.id, a.staff_id, s.name as staff_name,  a.username, a.password, a.is_active, a.note, a.is_deleted 
                             FROM
                        `account` a join staff s on a.staff_id = s.id
                        where is_deleted = 0";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addAccount($name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO unit (name, note) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $note);

    $result = $stmt->execute();
    return $result;
}

function editAccount($id, $name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `unit` 
                            SET 
                                `name`= ?,
                                `note`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $name, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeAccount($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `unit` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Login">
function login($account, $password) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "SELECT 
                a.id, s.id, s.name as staff_name,  a.username
                     FROM
                `account` a join staff s on a.staff_id = s.id
                where is_deleted = 0 and username = ? and password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $account, $password);

    $stmt->execute();
    $stmt->bind_result($account_id, $staff_id, $staff_name, $username);
    while ($stmt->fetch()) {
        $data['account_id'] = $account_id;
        $data['staff_id'] = $staff_id;
        $data['staff_name'] = $staff_name;
        $data['username'] = $username;
    }


    $count = $stmt->num_rows;

    $return_result['count'] = $count;
    if (!isset($data)) {
        $data = null;
    }
    $return_result['data'] = $data;
    return $return_result;
//    if ($row[0] > 0) {
//        return true;
//    }

    return false;
}

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="provider">
function getProvider() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }
    $query = "SELECT 
                    id, 
                    name, 
                    phone, 
                    email, 
                    address, 
                    note 
                FROM provider 
                WHERE is_deleted = 0";
    
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function addProvider($name, $phone, $email, $address, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT 
                                INTO provider(name, phone, email, address, note) 
                                VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $email, $address, $note);

    $result = $stmt->execute();
    return $result;
}

function editProvider($id, $name, $phone, $email, $address, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE provider 
                                SET
                                    name=?,
                                    phone=?,
                                    email=?,
                                    address=?,
                                    note=?
                                WHERE id = ?");
    $stmt->bind_param("ssssss", $name, $phone, $email, $address, $note, $id);

    $result = $stmt->execute();
    return $result;
}

function removeProvider($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `provider` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Order in">
function getOrderIn() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addOrderIn($staff_id, $provider_id, $total, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO 
                            `order_in`
                            (`staff_id`,`provider_id`, `total`, `note`) 
                             VALUES
                             (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $staff_id, $provider_id, $total,  $note);

    $result['status'] = $stmt->execute();
    $result['order_in_id'] = $stmt->insert_id;
    return $result;
}

function editOrderIn($id, $cat_id, $unit_id, $name, $description, $price, $image) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `product` SET
                            `cat_id`= ? ,`unit_id`=?,
                            `name`=?,`description`=?,
                            `price`= ?,`image`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $cat_id, $unit_id, $name, $description, $price, $image, $id);

    $result = $stmt->execute();
    return $result;
}

function removeOrderIn($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `product` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Order in Detail">
function getOrderInDetail() {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $query = "";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addOrderInDetail($order_in_id, $product_id, $product_quantity, $product_price, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO
                            `order_in_detail`
                                (`order_in_id`, `product_id`, 
                                 `quantity`, `price`, 
                                 `note`) 
                                VALUES 
                                (?, ?,
                                 ?, ?,
                                 ?)");
    
    $stmt->bind_param("sssss", $order_in_id, $product_id, $product_quantity, $product_price, $note);

    $result = $stmt->execute();
    return $result;
}

function editOrderInDetail($id, $cat_id, $unit_id, $name, $description, $price, $image) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `product` SET
                            `cat_id`= ? ,`unit_id`=?,
                            `name`=?,`description`=?,
                            `price`= ?,`image`= ?
                            WHERE `id`= ?");
    $stmt->bind_param("sss", $cat_id, $unit_id, $name, $description, $price, $image, $id);

    $result = $stmt->execute();
    return $result;
}

function removeOrderInDetail($id) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `product` 
                            SET 
                                `is_deleted`= true
                            WHERE `id`= ?");
    $stmt->bind_param("s", $id);

    $result = $stmt->execute();
    return $result;
}

// </editor-fold>
