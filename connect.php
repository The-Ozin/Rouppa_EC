<?php
$servername = "localhost";
$username = "root";
$password = "PUC@1234";
$database = "rouppa";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
