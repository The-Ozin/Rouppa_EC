<?php
    $servername = "localhost";
    $username = "root";
    $password = "PUC@1234";
    $database = "Rouppa";


    $conn = new mysqli($servername, $username, $password, $database);


    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }  
?>