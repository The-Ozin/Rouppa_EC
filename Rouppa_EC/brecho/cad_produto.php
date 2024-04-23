<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connect.php");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $tamanho = $_POST["tamanho"];
    $preco = $_POST["preco"];
    $genero = $_POST["genero"];
    $descricao = $_POST["descricao"];

    // Processa o upload da imagem
    $imagem_nome = $_FILES["foto"]["name"];
    $imagem_temp = $_FILES["foto"]["tmp_name"];
    $imagem_destino = "../imagens/produtos/" . $imagem_nome;

    if (move_uploaded_file($imagem_temp, $imagem_destino)) {
        // Insere os dados do produto na tabela produto_brecho
        $sql = "INSERT INTO produto_brecho (nome_produto, categoria, tamanho, descricao, preco, genero, foto_pb) 
                VALUES ('$nome', '$categoria', '$tamanho', '$descricao', '$preco', '$genero', '$imagem_nome')";

        if ($conn->query($sql) === TRUE) {
            echo "Produto cadastrado com sucesso.";
            // Redireciona para a página principal do brechó após o cadastro
            header("Location: ../brecho/main_brecho.html");
        } else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
}
?>

