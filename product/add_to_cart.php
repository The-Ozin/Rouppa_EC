<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['prod_id'])) {
        $prod_id = $_POST['prod_id'];
        $tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$prod_id])) {
            $_SESSION['cart'][$prod_id] = 1;
        } else {
            $_SESSION['cart'][$prod_id]++;
        }

        echo 'success';
        exit();
    } else {
        echo 'Produto não encontrado.';
        exit();
    }
} else {
    echo 'Método de requisição inválido.';
    exit();
}

