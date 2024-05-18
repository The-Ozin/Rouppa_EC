<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = $_FILES['foto']['name'];
    $target_dir = "../shop_images/";
    $target_file = $target_dir . basename($foto);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica se o arquivo é uma imagem real ou um arquivo fake
    $check = getimagesize($_FILES['foto']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    // Verifica o tamanho do arquivo
    if ($_FILES['foto']['size'] > 500000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Permite apenas determinados formatos de arquivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        $uploadOk = 0;
    }

    // Verifica se $uploadOk está definido como 0 devido a um erro
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    // Se tudo estiver ok, tenta enviar o arquivo
    } else {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO produto (nome, tamanho, descricao_, preco, foto) VALUES ('$nome', '$tamanho', '$descricao', '$preco', '$foto')";
            if (mysqli_query($conn, $sql)) {
                echo "O arquivo " . htmlspecialchars(basename($foto)). " foi enviado com sucesso.";
                echo "Novo registro criado com sucesso.";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Desculpe, ocorreu um erro ao enviar seu arquivo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form action="product_register.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="tamanho">Tamanho:</label>
        <input type="text" id="tamanho" name="tamanho" required><br><br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>
        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br><br>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" required><br><br>
        <input type="submit" value="Cadastrar Produto">
    </form>
</body>
</html>
