<?php 
include("../connect.php");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);    
}
$email=$_POST["email"];
$senha=$_POST["senha"];

$sql= "SELECT * from usuario where email= '$email' AND senha= '$senha' ";
$result=$conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Email ou senha incorretos');</script>";  

    session_start();
    $_SESSION['username'] = $username;
} else {
    echo "<script>alert('Email ou senha incorretos'); window.location.href='login_usuario.html';</script>";
    exit;
}
header("Location: ../main_index/main_index.html"); 
?>