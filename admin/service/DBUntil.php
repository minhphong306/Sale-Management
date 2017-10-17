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

    $query = "SELECT id, name, note, is_deleted FROM category order by name";
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
            p.id, p.cat_id, c.name as category_name,
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
                            (`cat_id`, `unit_id`, `name`,
                             `description`, `price`, `image`)
                             VALUES 
                             (?, ?, ?
                             ?, ?, ?)");
    $stmt->bind_param("ssssss", $cat_id, $unit_id, $name, $description, $price, $image);

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

