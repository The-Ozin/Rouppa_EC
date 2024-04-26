<?php
    // Establish database connection
    include("../connect.php");

    // Check if connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get values from POST data
    $id_adm = $_POST['id_adm'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Prepare and execute SQL query
    $sql = "INSERT INTO adm (id_adm, cpf, senha) VALUES ('$id_adm', '$cpf', '$senha')";
    if ($conn->query($sql) === TRUE) {
        ?>
        <script>
            Header("Location: adm_login.php");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Erro no cadastro: <?php echo $conn->error; ?>');
            history.go(-1);
        </script>
        <?php
    }

    // Close the database connection
    $conn->close();
?>
