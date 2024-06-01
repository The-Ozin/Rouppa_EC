<?php
include('../connect.php');
session_start();

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (empty($email) || empty($senha)) {
    $_SESSION['login_error'] = "Email ou senha não preenchidos.";
    header("Location: user_login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['user_name'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['cpf'] = $usuario['cpf'];
        $_SESSION['foto'] = $usuario['foto'];
        header("Location: http://localhost/Rouppa_EC/welcome.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Credenciais inválidas. Tente novamente.";
        header("Location: user_login.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['login_error'] = "Erro: " . $e->getMessage();
    header("Location: user_login.php");
    exit();
}


