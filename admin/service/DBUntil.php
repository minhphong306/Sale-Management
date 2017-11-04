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

    $query = "SELECT id, name, note, is_deleted FROM category  where is_deleted = 0 order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addCategory($name, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO category (name, note) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $note);

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
            p.price, pmd.promotion_value,
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

    $query = "SELECT `id`, `name`, `phone`, `email`, `address`, `facebook`, `note` FROM `customer` order by name";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addCustomer($name, $phone, $email, $address, $facebook, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("INSERT INTO `customer` 
                            (`name`, `phone`, `email`,
                            `address`, `facebook`, `note`) 
                             VALUES 
                             (?, ?, ?,
                             ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $phone, $email, $address, $facebook, $note);

    $result = $stmt->execute();
    return $result;
}

function editCustomer($id, $name, $phone, $email, $address, $facebook, $note) {
    $conn = getConnection();
    if ($conn->connect_error) {
        return "error";
    }

    $stmt = $conn->prepare("UPDATE `customer`
                        SET 
                            `name`=?, `phone`= ?,
                            `email`=?, `address`=?,
                            `facebook`= ?,`note`=?
                        WHERE `id` = ?");
    $stmt->bind_param("sssssss", $name, $phone, $email, $address, $facebook, $note, $id);

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

    $query = "SELECT count(*) as total
    from 
	account 
    where username = ? and password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $account, $password);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    if ($row[0] > 0) {
        return true;
    }

    return false;
}

// </editor-fold>
