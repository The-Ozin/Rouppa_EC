<?php
$servername = "localhost";
$username = "root";
$password = "wordpass";
$database = "rouppa"; // <-- Corrected variable name

$conn = new mysqli($servername, $username, $password, $database); // <-- Use $database here

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
