<?php 
include("../connect.php");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);    
}
$id_adm=$_POST["id_adm"];
$senha=$_POST["senha"];

$sql= "SELECT * from adm where id_adm= '$id_adm' AND senha= '$senha' ";
$result=$conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Email ou senha incorretos');</script>";  

    session_start();
    $_SESSION['username'] = $username;
} else {
    echo "<script>alert('Email ou senha incorretos'); window.location.href='login_adm.html';</script>";
    exit;
}
header("Location: adm_main.html"); 
?>