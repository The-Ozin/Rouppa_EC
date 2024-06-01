<?php
include('../connect.php');
session_start();

$cnpj = isset($_POST['cnpj']) ? trim($_POST['cnpj']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (empty($cnpj) || empty($senha)) {
    $_SESSION['login_error'] = "CNPJ ou senha não preenchidos.";
    header("Location: shop_login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM loja WHERE cnpj = :cnpj");
    $stmt->execute(['cnpj' => $cnpj]);
    $loja = $stmt->fetch();

    if ($loja && password_verify($senha, $loja['senha'])) {
        $_SESSION['nome_loja'] = $loja['nome'];
        $_SESSION['email_loja'] = $loja['email'];
        $_SESSION['cnpj'] = $loja['cnpj'];
        $_SESSION['endereco'] = $loja['endereco'];

        if (!empty($loja['foto'])) {
            $_SESSION['foto_loja'] = $loja['foto'];
        }

        header("Location: ../welcome.php");
        exit();
    } else {
        $_SESSION['login_error'] = "Credenciais inválidas. Tente novamente.";
        header("Location: shop_login.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['login_error'] = "Erro: " . $e->getMessage();
    header("Location: shop_login.php");
    exit();
}
?>
