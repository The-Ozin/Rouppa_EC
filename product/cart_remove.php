<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['prod_id'])) {
    $prod_id = $_POST['prod_id'];

    if (isset($_SESSION['cart'][$prod_id])) {
        unset($_SESSION['cart'][$prod_id]);
    }
}

header("Location: cart.php");
exit();
