<?php
@include('../connect.php'); // Inclua o script de conexão com o banco de dados

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cnpj = trim($_POST['registerCNPJ']);
    $nome = trim($_POST['registerStoreName']);
    $endereco = trim($_POST['registerAddress']);
    $senha = trim($_POST['registerPassword']);
    $foto = isset($_FILES['registerPhoto']) ? $_FILES['registerPhoto'] : null;

    // Realize as validações...

    // Verifique se um arquivo foi enviado
    $fotoPath = null;
    if ($foto && $foto['error'] == UPLOAD_ERR_OK) {
        $targetDirectory = 'C:/xampp/htdocs/Rouppa/pfp/'; // Caminho local no sistema de arquivos
        $fileName = basename($foto['name']);
        $targetFilePath = $targetDirectory . $fileName;

        // Mova o arquivo enviado para o diretório de destino
        if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
            // Armazene o caminho relativo para a imagem no banco de dados
            $fotoPath = 'pfp/' . $fileName;
        } else {
            echo "Erro ao enviar a foto.";
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
