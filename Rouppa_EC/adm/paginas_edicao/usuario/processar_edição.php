<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['excluir']) && $_POST['excluir'] == '1') {
        $cpf = $_POST['cpf'];
        $sql = "DELETE FROM usuario WHERE cpf = '$cpf'";
        if ($conn->query($sql) === TRUE) {
            header("location: edição_usuario.php");
        } else {
            echo "Erro ao excluir usuário: " . $conn->error;
        }
    } else {
        $cpf_original = $_POST['cpf_original'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nova_senha = $_POST['nova_senha'];

        if (!empty($nova_senha)) {
            
            $senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
        }
        
        $sql = "UPDATE usuario SET ";
        
        if (!empty($nome)) {
            $sql .= "nome = '$nome', ";
        }
        
        if (!empty($email)) {
            $sql .= "email = '$email', ";
        }
        
        if (isset($senha_criptografada)) {
            $sql .= "senha = '$senha_criptografada', ";
        }
        
        $sql = rtrim($sql, ", ");
        
        $sql .= " WHERE cpf = '$cpf_original'";

        if ($conn->query($sql) === TRUE) {
            header("location: edição_usuario.php");
        } else {
            echo "Erro ao atualizar usuário: " . $conn->error;
        }
    }
}

$conn->close();
?>
