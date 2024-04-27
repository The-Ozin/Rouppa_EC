<?php
session_start();

// Verificar se o usuário está logado
if(isset($_SESSION["email"])) {
    // Se estiver logado, retornar o nome do usuário
    include("../connect.php");
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    $email = $_SESSION["email"];
    $sql = "SELECT nome FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomeUsuario = $row["nome"];
        echo $nomeUsuario;
    } else {
        echo "Usuário";
    }
    $conn->close();
} else {
    // Se não estiver logado, exibir "Login"
    echo "Login";
}
?>


