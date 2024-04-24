<?php
    include("../paginas_edicao/usuario/connect.php");
    $id_adm = $_POST['id_adm'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $sql = "INSERT INTO adm VALUES('$id_adm','$cpf', '$senha')";
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