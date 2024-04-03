<?php
include("../connect.php");
$nome = $_POST["nome"];
$email = $_POST["email"];
$cep = $_POST["cep"];
$senha = $_POST["senha"];
$cnpj = $_POST["cnpj"];

$sql = "INSERT INTO loja(cnpj, nome_loja, email_comercial, cep, senha) VALUES('$cnpj', '$nome', '$email', '$cep', '$senha')";
$result = $conn->query($sql);

if ($result === TRUE) {
    ?>
    <script>
        alert('loja cadastrada');
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