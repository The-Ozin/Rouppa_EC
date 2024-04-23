<!DOCTYPE html>
<html>
<head>
    <title>Lista e Edição de Usuários</title>
</head>
<body>

<h2>Lista de Usuários</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Editar</th>
    </tr>
    <?php
    include ("./connect.php");
    $query = "SELECT * FROM usuario";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($user = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $user['cpf']; ?></td>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['data_nascimento']; ?></td>
                <td><a href="?id=<?php echo $user['cpf']; ?>">Editar</a></td>
            </tr>
            <?php
        }
    } else {
        echo "Nenhum usuário encontrado.";
    }
    ?>
</table>

<?php
include "./connect.php";
if(isset($_GET['cpf'])) {

    $user_id = $_GET['cpf'];


    $query = "SELECT * FROM usuario WHERE cpf = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        ?>
        <h2>Edição de Usuário</h2>
        <form action="processar_edicao.php" method="post">
            <input type="hidden" name="cpf" value="<?php echo $user['cpf']; ?>">
            Nome: <input type="text" name="nome" value="<?php echo $user['nome']; ?>"><br>
            Email: <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
            <input type="submit" value="Salvar">
        </form>
        <?php
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

</body>
</html>
