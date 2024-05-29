<?php
session_start();

// Destrua a sessão
session_destroy();

// Redirecione para a página de login
header("Location: http://localhost/Rouppa_EC/user/user_login.php");
exit();
?>
