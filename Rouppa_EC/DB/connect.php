<?php
$servername = "nome_do_server";
$username = "root";
$password = "criar_senha";
$dbname = "RouppaDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
