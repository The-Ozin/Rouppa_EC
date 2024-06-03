<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_name'])) {
    // Redirecionar para a página de login se o usuário não estiver logado
    header("Location: user_login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
include('../connect.php');

// Verificar se todos os campos do formulário foram enviados
if (isset($_POST['registerName']) && isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['registerRepeatPassword']) && isset($_POST['registerBirthdate'])) {
    // Recuperar os dados do formulário
    $name = $_POST['registerName'];
    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $repeatPassword = $_POST['registerRepeatPassword'];
    $birthdate = $_POST['registerBirthdate'];

    // Validar os campos (por exemplo, verificar se o email é válido, se as senhas coincidem, etc.)

    // Atualizar os dados do usuário no banco de dados
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
    // Se algum campo estiver faltando, redirecionar de volta para o formulário de perfil
    $_SESSION['update_profile_error'] = "Todos os campos são obrigatórios.";
    header("Location: profile.php");
    exit();
}
?>
