<?php
@include('../connect.php'); // Inclua o script de conexão com o banco de dados

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cnpj = trim($_POST['registerCNPJ']);
    $nome = trim($_POST['registerStoreName']);
    $endereco = trim($_POST['registerAddress']);
    $senha = trim($_POST['registerPassword']);
    $foto = isset($_FILES['registerStorePhoto']) ? $_FILES['registerStorePhoto'] : null;

    // Perform validations...

    // Check if a file was uploaded
    $fotoPath = null;
    if ($foto && $foto['error'] == UPLOAD_ERR_OK) {
        $targetDirectory = '../pfp/'; // Diretório onde as fotos da loja serão salvas
        $fileName = basename($foto['name']);
        $targetFilePath = $targetDirectory . $fileName;

        // Mova o arquivo enviado para o diretório de destino
        if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
            // Armazene o caminho relativo para a foto da loja no banco de dados
            $fotoPath = '../pfp/' . $fileName;
        } else {
            echo "Erro ao enviar a foto da loja.";
            exit();
        }
    }
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO loja (cnpj, nome, endereco, senha, foto) VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    if ($stmt) {
        $stmt->bindParam(1, $cnpj);
        $stmt->bindParam(2, $nome);
        $stmt->bindParam(3, $endereco);
        $stmt->bindParam(4, $hashedPassword);
        $stmt->bindParam(5, $fotoPath);

        if ($stmt->execute()) {
            header("Location: ../shop/shop_login.php");
            exit(); // Termina o script após redirecionar
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
