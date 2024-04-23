<?php
session_start();
if (!isset($_SESSION['email'])) {
    // Redireciona o usuário para a página de login se não estiver logado
    header("Location: login_usuario.html");
    exit;
}
?>