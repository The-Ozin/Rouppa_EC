<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o ID do produto foi enviado
    if (isset($_POST['prod_id'])) {
        $prod_id = $_POST['prod_id'];

        // Verifica se o carrinho já existe na sessão
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Adiciona o produto ao carrinho
        if (!isset($_SESSION['cart'][$prod_id])) {
            $_SESSION['cart'][$prod_id] = 1; // Adiciona o produto ao carrinho com quantidade 1
        } else {
            $_SESSION['cart'][$prod_id]++; // Incrementa a quantidade do produto no carrinho
        }

        // Redireciona de volta à página de produtos ou a uma página de confirmação
        header('Location: produtos.php');
        exit();
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
