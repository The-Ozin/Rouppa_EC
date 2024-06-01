<?php
include('../connect.php');
session_start();

// Captura os dados do formulário
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

header('Content-Type: application/json');

if (empty($email) || empty($senha)) {
    echo json_encode(["success" => false, "error" => "Email ou senha não preenchidos."]);
    exit();
}

try {
    // Debug: verificar valores capturados
    error_log("Email: $email");
    error_log("Senha: $senha");

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    // Debug: verificar dados retornados da consulta
    error_log("Usuario: " . print_r($usuario, true));

    if ($usuario) {
        // Debug: verificar se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Define as variáveis de sessão após o login bem-sucedido
            $_SESSION['user_name'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['cpf'] = $usuario['cpf'];
            $_SESSION['foto'] = $usuario['foto']; // Armazena o caminho relativo da foto do usuário
        
            // Retorna uma resposta de sucesso
            echo json_encode(["success" => true, "redirect" => "../welcome.php"]);
            exit();
        } else {
            echo json_encode(["success" => false, "error" => "Senha incorreta. Tente novamente."]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "error" => "Usuário não encontrado. Verifique suas credenciais."]);
        exit();
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro ao acessar o banco de dados: " . $e->getMessage()]);
    exit();
}


