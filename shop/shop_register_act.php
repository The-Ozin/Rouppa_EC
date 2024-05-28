<?php
@include('../connect.php'); // Inclua o script de conexão com o banco de dados

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cnpj = trim($_POST['registerCNPJ']);
    $nome = trim($_POST['registerStoreName']);
    $endereco = trim($_POST['registerAddress']);
    $senha = trim($_POST['registerPassword']);

    // Realize as validações...

    // Verifique se um arquivo foi enviado

    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO loja (cnpj, nome, endereco, senha) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt) {
        $stmt->bindParam(1, $cnpj);
        $stmt->bindParam(2, $nome);
        $stmt->bindParam(3, $endereco);
        $stmt->bindParam(4, $hashedPassword);
    
        if ($stmt->execute()) {
            header("Location: ../shop/shop_login.php");
            exit(); // Termina o script após redirecionar
        } else {
            echo "Erro ao cadastrar: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Erro no preparo da declaração: " . $pdo->errorInfo()[2];
    }
} else {
    echo "Método de requisição inválido.";
}
?>
