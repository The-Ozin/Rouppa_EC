<?php
session_start();


if (!isset($_SESSION['user_name'])) {
    header("Location: user_login.php");
    exit();
}


include('../connect.php');

if (isset($_POST['registerName']) && isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['registerRepeatPassword']) && isset($_POST['registerBirthdate'])) {
    // Recuperar os dados do formulário
    $name = $_POST['registerName'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $repeatPassword = $_POST['registerRepeatPassword'];
    $birthdate = $_POST['registerBirthdate'];

    try {
        $stmt = $pdo->prepare("UPDATE usuario SET nome = ?, email = ?, senha = ?, data_nascimento = ? WHERE cpf = ?");
        $stmt->execute([$name, $email, $password, $birthdate, $_SESSION['user_name']]);
        $_SESSION['update_profile_success'] = "Perfil atualizado com sucesso!";
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['update_profile_error'] = "Erro ao atualizar perfil: " . $e->getMessage();
        header("Location: profile.php");
        exit();
    }
} else {
    $_SESSION['update_profile_error'] = "Todos os campos são obrigatórios.";
    header("Location: profile.php");
    exit();
}
?>
