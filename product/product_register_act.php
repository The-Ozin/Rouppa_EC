<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name']) && !isset($_SESSION['nome_loja'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}

$isUsuario = isset($_SESSION['cpf']);
$isLoja = isset($_SESSION['cnpj']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'], $_POST['productCategory'], $_POST['tamanho'], $_POST['descricao'], $_POST['preco'], $_POST['condicao_uso'], $_FILES['fotos'])) {

    $nome = $conn->real_escape_string($_POST['nome']);
    $categoria = $conn->real_escape_string($_POST['productCategory']);
    $tamanho = $conn->real_escape_string($_POST['tamanho']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $preco = $conn->real_escape_string($_POST['preco']);
    $condicao_uso = (int)$_POST['condicao_uso'];

    $tipo_usuario = $isUsuario ? 'usuario' : 'loja';

    $fk_loja_cnpj = $isLoja ? "'" . $conn->real_escape_string($_SESSION['cnpj']) . "'" : "NULL";
    $fk_usuario_cpf = $isUsuario ? "'" . $conn->real_escape_string($_SESSION['cpf']) . "'" : "NULL";

    $query = "INSERT INTO produto (nome, descricao_, categoria, tamanho, preco, condicao_uso, fk_loja_cnpj, fk_usuario_cpf, tipo_usuario) VALUES ('$nome', '$descricao', '$categoria', '$tamanho', '$preco', '$condicao_uso', $fk_loja_cnpj, $fk_usuario_cpf, '$tipo_usuario')";

    if (mysqli_query($conn, $query)) {
        $prod_id = mysqli_insert_id($conn);

        if (!empty($_FILES['fotos']['tmp_name'][0])) {
            $num_files = count($_FILES['fotos']['tmp_name']);

            for ($i = 0; $i < $num_files; $i++) {
                $foto = addslashes(file_get_contents($_FILES['fotos']['tmp_name'][$i]));

                $insert_query = "INSERT INTO produto_fotos (prod_id, foto) VALUES ('$prod_id', '$foto')";
                mysqli_query($conn, $insert_query);
            }
        } else {
            die("Error: Fotos não foram enviadas.");
        }
        if ($isUsuario) {
            header("Location: http://localhost/Rouppa_EC/user/brecho.php");
        } else {
            header("Location: http://localhost/Rouppa_EC/shop/shop.php");
        }
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
