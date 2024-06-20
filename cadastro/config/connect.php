<?php
$localHost = "localhost";
$userName = "root";
$password = "Mlkzika013@";
$db_name = "acis";

// Create connection
$conn = new mysqli($localHost, $userName, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
