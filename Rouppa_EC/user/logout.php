<?php
session_start();
session_destroy();
// Redireciona o usuário de volta para a página de login após o logout
header("Location: login_usuario.html");
exit;
?>