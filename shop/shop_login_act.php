<?php
include('../connect.php');
session_start();

// Captura os dados do formulário
$cnpj = isset($_POST['cnpj']) ? trim($_POST['cnpj']) : '';
$senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

if (empty($cnpj) || empty($senha)) {
    echo json_encode(["success" => false, "error" => "CNPJ ou senha não preenchidos."]);
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM loja WHERE cnpj = :cnpj");
    $stmt->execute(['cnpj' => $cnpj]);
    $loja = $stmt->fetch();

    if ($loja && password_verify($senha, $loja['senha'])) {
        // Define as variáveis de sessão após o login bem-sucedido
        $_SESSION['nome_loja'] = $loja['nome'];
        $_SESSION['email_loja'] = $loja['email'];
        $_SESSION['cnpj'] = $loja['cnpj'];
        $_SESSION['endereco'] = $loja['endereco'];
    
        // Redireciona para a página de boas-vindas da loja
        header("Location: ../welcome.php");
        exit();
    } else {
        echo json_encode(["success" => false, "error" => "Credenciais inválidas. Tente novamente."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro: " . $e->getMessage()]);
}
?>
