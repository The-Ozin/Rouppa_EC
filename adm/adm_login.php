<?php
// Verifica se há um erro na URL
if (isset($_GET['error'])) {
    // Obtém o erro da URL e decodifica (remove os caracteres especiais)
    $error = urldecode($_GET['error']);
    // Exibe a mensagem de erro na página
    echo "<p style='color: red;'>$error</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
</head>
<body>
    <h2>Login de Administrador</h2>
    <form method="post" action="adm_login_act.php">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id"><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br><br>
        <input type="submit" value="Login">
    </form>


    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
</body>
</html>
