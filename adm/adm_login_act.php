<?php
session_start();
include('../connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM adm WHERE cpf = '$cpf'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_senha = $row['senha_hash'];


        if (hash('sha256', $senha) === $hashed_senha) {

            $_SESSION['adm_cpf'] = $cpf;
            $_SESSION['adm_name'] = $row['nome'];
            $_SESSION['adm_foto'] = $row['foto'];

            header("Location: adm.php");
            exit();
        } else {

            $_SESSION['login_error'] = "Senha incorreta";
            header("Location: adm_login.php");
            exit();
        }
    } else {

        $_SESSION['login_error'] = "ID de administrador não encontrado";
        header("Location: adm_login.php");
        exit();
    }
}
?>
