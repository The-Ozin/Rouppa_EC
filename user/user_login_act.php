<?php
include('../connect.php');
session_start();

// Definir o tempo limite de sessão em segundos (por exemplo, 30 minutos)
$session_timeout = 30 * 60; // 30 minutos

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $session_timeout)) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['login_error'] = "Sessão expirada. Faça login novamente.";
    header("Location: user_login.php");
    exit();
}
// Atualiza o timestamp da última atividade para o tempo atual
$_SESSION['LAST_ACTIVITY'] = time();

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
        // Destrói a sessão atual antes de iniciar uma nova
        session_unset();
        session_destroy();
        session_start();

        $_SESSION['user_name'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['cpf'] = $usuario['cpf'];
        $_SESSION['senha'] = $usuario['senha'];
        $_SESSION['foto'] = $usuario['foto'];
        $_SESSION['LAST_ACTIVITY'] = time(); // Inicializa a última atividade
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
?>