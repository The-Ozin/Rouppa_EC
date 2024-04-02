<?php
include("connect.php");
$nome = $_POST["nome"];
$email = $_POST["email"];
$data_nsc = $_POST["data"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];

$sql = "INSERT INTO usuario(cpf, nome, email, data_nascimento, senha) VALUES('$cpf', '$nome', '$email', '$data_nsc', '$senha')";
$result = $conn->query($sql);

if ($result === TRUE) {
    ?>
    <script>
        alert('Cliente cadastrado');
    </script>
    <?php
} else {
    ?>
    <script>
        alert('Erro no cadastro');
        history.go(-1);
    </script>
    <?php
}
?>