<?php
include('../connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $senha = $_POST['senha'];

    // Consulta SQL para buscar o administrador pelo ID e senha
    $query = "SELECT * FROM adm WHERE id = '$id' AND senha = '$senha'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login bem-sucedido, redireciona para adm.php
        ob_clean();
        header("Location: adm.php");
        exit();
    } else {
        // ID de administrador ou senha incorretos
        $error = "ID de administrador ou senha incorretos";
    }
}
?>
