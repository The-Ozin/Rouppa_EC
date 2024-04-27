<?php
session_start();

// Definir uma variável para indicar se o usuário está logado
$usuarioLogado = false;
$nomeUsuario = "Login";

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["senha"])) {
    include("../connect.php");

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);    
    }

    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Inicia uma sessão antes de redirecionar
        $_SESSION['email'] = $email;
        header("Location: ../main_index/main_index1.php");
        exit; // Encerra o script após o redirecionamento
    } else {
        echo "<script>alert('Email ou senha incorretos'); window.location.href='login_usuario.html';</script>";
        exit;
    }

    // Remove the line below as it is unnecessary in this context
    // $conn->close();
}
?>

