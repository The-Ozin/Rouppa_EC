<?php 
include("../connect.php");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);    
}

$email = $_POST["email"];
$senha = md5($_POST["senha"]);

$sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['email'] = $email;
    header("Location: ../main_index/main_index.html");
} else {
    echo "<script>alert('Email ou senha incorretos'); window.location.href='login_usuario.html';</script>";
    exit;
}
?>
