<?php
session_start();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['nome_loja'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o ID do produto foi enviado
    if (isset($_POST['prod_id'])) {
        $prod_id = $_POST['prod_id'];
        $tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';

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

        // Redireciona de volta à página correspondente (loja ou brechó)
            header('Location: http://localhost/Rouppa_EC/shop/shop.php');

        exit();
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
