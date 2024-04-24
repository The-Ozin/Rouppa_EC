<?php
include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['excluir']) && $_POST['excluir'] == '1') {
        $cnpj = $_POST['cnpj'];
        $sql = "DELETE FROM loja WHERE cnpj = '$cnpj'";
        if ($conn->query($sql) === TRUE) {
            header("location: edição_loja.php");
        } else {
            echo "Erro ao excluir loja: " . $conn->error;
        }
    } else {
        $cnpj_original = $_POST['cnpj_original'];
        $nome_loja = isset($_POST['nome_loja']) ? $_POST['nome_loja'] : '';
        $email_comercial = isset($_POST['email_comercial']) ? $_POST['email_comercial'] : '';
        $cep = isset($_POST['cep']) ? $_POST['cep'] : '';

        $sql = "UPDATE loja SET ";
        if (!empty($nome_loja)) {
            $sql .= "nome_loja = '$nome_loja', ";
        }
        if (!empty($email_comercial)) {
            $sql .= "email_comercial = '$email_comercial', ";
        }
        if (!empty($cep)) {
            $sql .= "cep = '$cep', ";
        }
        
        $sql = rtrim($sql, ", ");
        
        $sql .= " WHERE cnpj = '$cnpj_original'";

        if ($conn->query($sql) === TRUE) {
            header("location:edição_loja.php");
            exit();
        } 
        else {
            header("location:edição_loja.php");
            exit();
        }
    }
}

$conn->close();
?>
