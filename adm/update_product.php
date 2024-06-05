<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['adm_name'])) {
    header('Location: http://localhost/Rouppa_EC/welcome.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['prod_id'], $_POST['nome'], $_POST['descricao_'], $_POST['preco'], $_POST['categoria'], $_POST['condicao_uso'], $_POST['estado_peca'])) {

        $prodId = $_POST['prod_id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao_'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        $condicaoUso = $_POST['condicao_uso'];
        $estadoPeca = $_POST['estado_peca'];

        $query = "UPDATE produto SET nome = '$nome', descricao_ = '$descricao', preco = '$preco', categoria = '$categoria', condicao_uso = '$condicaoUso', estado_peca = '$estadoPeca' WHERE prod_id = '$prodId'";
        if (mysqli_query($conn, $query)) {

            header('Location: produtos_adm.php');
            exit();
        } else {

            echo "Erro ao atualizar o produto: " . mysqli_error($conn);
        }
    } else {

        echo "Todos os campos devem ser preenchidos.";
    }
} else {

    echo "Acesso não autorizado.";
}
?>
