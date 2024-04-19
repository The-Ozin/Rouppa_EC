<?php
include("../connect.php");
$id_adm = $_POST["id_adm"];
$senha = $_POST["senha"];
$cpf = $_POST["cpf"];

$sql = "INSERT INTO adm(id_adm, cpf, senha) VALUES('$id_adm','$cpf', '$senha')";
$result = $conn->query($sql);

if ($result === TRUE) {
    ?>
    <script>
        alert('adm cadastrado');
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