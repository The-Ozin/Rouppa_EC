<?php
include("../connect.php");

session_start();
if (isset($_SESSION['email'])) {
    // O usuário está logado, então você pode exibir uma saudação com o nome dele
    $email = $_SESSION['email'];

    // Aqui você pode fazer uma consulta ao banco de dados para obter o nome do usuário usando o e-mail, ou apenas exibir o e-mail mesmo
    $nome_usuario = "Usuário"; // Você pode substituir isso com o nome real do usuário, se tiver essa informação no seu banco de dados
}
?>

