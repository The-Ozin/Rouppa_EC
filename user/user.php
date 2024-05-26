<?php
@include('../connect.php'); // Include the database connection script

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['registerName']);
    $email = trim($_POST['registerEmail']);
    $senha = trim($_POST['registerPassword']);
    $cpf = trim($_POST['registerCPF']);
    $data_nascimento = trim($_POST['registerBirthdate']);
    $foto = isset($_FILES['registerPhoto']) ? $_FILES['registerPhoto'] : null;

    // Perform validations...

    // Check if a file was uploaded
    $fotoPath = null;
    if ($foto && $foto['error'] == UPLOAD_ERR_OK) {
        $targetDirectory = '../pfp/'; // Caminho local no sistema de arquivos
        $fileName = basename($foto['name']);
        $targetFilePath = $targetDirectory . $fileName;

        // Mova o arquivo enviado para o diretório de destino
        if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
            // Armazene o caminho relativo para a imagem no banco de dados
            $fotoPath = '../pfp/' . $fileName;
        } else {
            echo "Error uploading the photo.";
            exit();
        }
    }
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome, email, senha, cpf, data_nascimento, foto) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    if ($stmt) {
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $hashedPassword);
        $stmt->bindParam(4, $cpf);
        $stmt->bindParam(5, $data_nascimento);
        $stmt->bindParam(6, $fotoPath);

        if ($stmt->execute()) {
            header("Location: ../user/user_login.php");
        } else {
            echo "Erro ao cadastrar: " . $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();
    } else {
        echo "Erro no preparo da declaração: " . $pdo->errorInfo()[2];
    }
} else {
    echo "Método de requisição inválido.";
}
?>
