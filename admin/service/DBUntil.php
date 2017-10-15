<?php

function getConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "PhongDP25#*";
    $dbname = "online_shopping";
    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
}

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
