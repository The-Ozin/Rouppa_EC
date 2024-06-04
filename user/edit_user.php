<?php
session_start();
include('../connect.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_name'])) {
    header('Location: http://localhost/Rouppa_EC/user/user_login.php');
    exit();
}

// Obtém o CPF do usuário logado
$cpf = $_SESSION['cpf'];

// Verifica se o formulário de atualização do usuário foi enviado
if (isset($_POST['update_user'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $foto = $_FILES['foto'];

    // Verifica se uma nova foto de perfil foi enviada
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = '../pfp/';
        $fileName = basename($foto['name']);
        $targetFilePath = $targetDirectory . $fileName;
        $_SESSION['foto'] = $fotoPath;

        // Move a foto para o diretório de destino
        if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
            // Define o caminho completo para a foto
            $fotoPath = 'pfp/' . $fileName;
        } else {
            echo "Erro ao fazer upload da foto.";
            exit();
        }
    }

    // Constrói a consulta SQL para atualizar os dados do usuário
    $query = "UPDATE usuario SET nome='$nome', email='$email'";
// Se uma nova foto de perfil foi enviada, adiciona-a à consulta
    if (isset($fotoPath)) {
        $query .= ", foto='$fotoPath'";
    } else {
        // Se nenhuma nova foto foi enviada, mantenha a foto atual no banco de dados
        $query .= ", foto='" . $_SESSION['foto'] . "'";
    }
    $_SESSION['user_name'] = $nome;
    $_SESSION['foto'] = $fotoPath;
    // Se uma nova senha foi fornecida, adiciona-a à consulta
    if (!empty($senha)) {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $query .= ", senha='$senhaCriptografada'";
    }

    // Se uma nova foto de perfil foi enviada, adiciona-a à consulta
    if (isset($fotoPath)) {
        $query .= ", foto='$fotoPath'";
    }

    $query .= " WHERE cpf='$cpf'";

    // Executa a consulta SQL
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Se a atualização for bem-sucedida, redireciona o usuário para a página de gerenciamento com uma mensagem de sucesso
        header('Location: http://localhost/Rouppa_EC/user/user_managment.php');
        exit();
    } else {
        // Se houver algum erro, redireciona o usuário para a página de gerenciamento com uma mensagem de erro
        header('Location: http://localhost/Rouppa_EC/user/user_managment.php?error=erro_atualizar_perfil');
        exit();
    }
}

// Se o usuário tentar acessar este script diretamente, redireciona-o de volta à página de gerenciamento
header('Location: http://localhost/Rouppa_EC/user/user_managment.php');
exit();
?>
