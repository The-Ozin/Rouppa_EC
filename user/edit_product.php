<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name'])) {
    header('Location: http://localhost/Rouppa_EC/user/user_login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST['prod_id'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $condicao = $_POST['condicao'];
    $cpf = $_SESSION['cpf'];

    $query = "UPDATE produto SET 
                nome = '$nome', 
                categoria = '$categoria', 
                tamanho = '$tamanho', 
                preco = '$preco', 
                descricao_ = '$descricao', 
                condicao_uso = '$condicao' 
              WHERE prod_id = '$productId' AND fk_usuario_cpf = '$cpf'";
              
    if (mysqli_query($conn, $query)) {
        header('Location: http://localhost/Rouppa_EC/user/user_product_managment.php');
    } else {
        echo "Erro ao atualizar o produto: " . mysqli_error($conn);
    }
}
?>
