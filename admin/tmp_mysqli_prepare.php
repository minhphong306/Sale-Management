<?php
$servername = "localhost";
$username = "root";
$password = "PhongDP25#*";
$dbname = "online_shopping";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO Category (name, note) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $note);

// set parameters and execute
$name = "John";
$note = "Doe";
$result = $stmt->execute();

echo "First: $result";

$name = "John";
$note = "Doe";
$result = $stmt->execute();

echo "Second: $result";

$name = "Johna";
$note = "Doe";
$result = $stmt->execute();

echo "Third: $result";

$stmt->close();
$conn->close();
?>