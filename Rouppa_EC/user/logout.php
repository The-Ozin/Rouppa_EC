<?php
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Se desejar destruir a sessão completamente, você também pode usar:
// session_destroy();

// Redirecionar para a página de login
header("Location: ../user/login_usuario.html");
exit;
?>
