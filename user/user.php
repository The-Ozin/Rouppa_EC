<?php
@include('../connect.php'); 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['registerName']);
    $email = trim($_POST['registerEmail']);
    $senha = trim($_POST['registerPassword']);
    $cpf = trim($_POST['registerCPF']);
    $data_nascimento = trim($_POST['registerBirthdate']);
    $foto = isset($_FILES['registerPhoto']) ? $_FILES['registerPhoto'] : null;

    $fotoPath = null;
    if ($foto && $foto['error'] == UPLOAD_ERR_OK) {
        $targetDirectory = '../pfp/'; // Caminho local no sistema de arquivos
        $fileName = basename($foto['name']);
        $targetFilePath = $targetDirectory . $fileName;

        if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
            $fotoPath = '../pfp/' . $fileName;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao fazer upload da foto.']);
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

        try {
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Cadastro realizado com sucesso!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar.']);
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo json_encode(['status' => 'error', 'message' => 'CPF já cadastrado.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar: ' . $e->getMessage()]);
            }
        }

        $stmt->closeCursor();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro no preparo da declaração: ' . $pdo->errorInfo()[2]]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
}
?>
