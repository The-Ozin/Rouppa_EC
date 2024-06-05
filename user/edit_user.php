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


    $query = "UPDATE usuario SET nome='$nome', email='$email'";

    if (isset($fotoPath)) {
        $query .= ", foto='$fotoPath'";
    } else {
        
        $query .= ", foto='" . $_SESSION['foto'] . "'";
    }
    $_SESSION['user_name'] = $nome;
    $_SESSION['foto'] = $fotoPath;

    if (!empty($senha)) {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $query .= ", senha='$senhaCriptografada'";
    }
    if (isset($fotoPath)) {
        $query .= ", foto='$fotoPath'";
    }

    $query .= " WHERE cpf='$cpf'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: http://localhost/Rouppa_EC/user/user_managment.php');
        exit();
    } else {
        header('Location: http://localhost/Rouppa_EC/user/user_managment.php?error=erro_atualizar_perfil');
        exit();
    }
}

header('Location: http://localhost/Rouppa_EC/user/user_managment.php');
exit();
?>
