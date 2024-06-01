<?php
session_start();
include('../connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Consulta SQL para buscar o administrador pelo cpf
    $query = "SELECT * FROM adm WHERE cpf = '$cpf'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_senha = $row['senha_hash'];

        // Verifica se a senha hash corresponde à senha fornecida
        if (hash('sha256', $senha) === $hashed_senha) {
            // Define as variáveis de sessão
            $_SESSION['adm_cpf'] = $cpf;
            $_SESSION['adm_name'] = $row['nome'];
            $_SESSION['adm_foto'] = $row['foto'];

            // Redireciona para a página de administração
            header("Location: adm.php");
            exit();
        } else {
            // Senha incorreta
            $_SESSION['login_error'] = "Senha incorreta";
            header("Location: adm_login.php");
            exit();
        }
    } else {
        // CPF de administrador não encontrado
        $_SESSION['login_error'] = "ID de administrador não encontrado";
        header("Location: adm_login.php");
        exit();
    }
}
?>
