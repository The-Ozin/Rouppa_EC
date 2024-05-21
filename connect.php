<?php
$servername = "localhost";
$username = "root";
$password = "Simba8!#";
$database = "rouppa";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Define o modo de erro PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Em caso de erro na conexão, exibe a mensagem de erro
    die("Connection failed: " . $e->getMessage());
}
?>
