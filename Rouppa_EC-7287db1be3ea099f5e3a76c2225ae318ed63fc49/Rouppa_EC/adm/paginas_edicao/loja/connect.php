<?php
    $servername = "localhost";
    $username = "root";
    $password = "Simba8!#";
    $database = "Rouppa";


    $conn = new mysqli($servername, $username, $password, $database);


    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }  
?>