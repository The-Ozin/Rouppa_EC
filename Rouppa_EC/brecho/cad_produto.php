<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $tamanho = $_POST["tamanho"];
    $preco = $_POST["preco"];
    $genero = $_POST["genero"];
    $descricao = $_POST["descricao"];

    
    $imagem_nome = $_FILES["foto"]["name"];
    $imagem_temp = $_FILES["foto"]["tmp_name"];
    $imagem_destino = "../imagens/produtos/" . $imagem_nome;

    if (move_uploaded_file($imagem_temp, $imagem_destino)) {
        
        $sql = "INSERT INTO produto_brecho (nome_produto, categoria, tamanho, descricao, preco, genero, foto_pb) 
                VALUES ('$nome', '$categoria', '$tamanho', '$descricao', '$preco', '$genero', '$imagem_nome')";

        if ($conn->query($sql) === TRUE) {
            echo "Produto cadastrado com sucesso.";
            header("Location: ./main_brecho.html");
        } 
        else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }
    } 
    else {
        echo "Erro ao fazer o upload da imagem.";}
}
?>

