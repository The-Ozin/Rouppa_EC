<?php
include('../connect.php');

// Verifica se o CPF do usuário foi passado via parâmetro na URL
if (isset($_GET['cpf'])) {
    // Obtém o CPF do usuário da URL
    $cpf = $_GET['cpf'];

    // Consulta para obter os dados do usuário com o CPF fornecido
    $query = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
    $result = mysqli_query($conn, $query);

    // Verifica se o usuário existe
    if (mysqli_num_rows($result) == 1) {
        // Obtém os dados do usuário
        $user = mysqli_fetch_assoc($result);
    } else {
        // Se o usuário não existe, redireciona de volta para a página de administração
        header("Location: admin.php");
        exit();
    }
} else {
    // Se o CPF do usuário não foi fornecido, redireciona de volta para a página de administração
    header("Location: admin.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa os dados do formulário e atualiza o usuário no banco de dados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];

    $query_update = "UPDATE usuarios SET nome='$nome', email='$email', data_nascimento='$data_nascimento' WHERE cpf = '$cpf'";
    mysqli_query($conn, $query_update);

    // Redireciona de volta para a página de administração após a edição
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <!-- Adicione seus estilos CSS aqui -->
</head>
<body>
    <h1>Editar Usuário</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?cpf=" . $cpf); ?>">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $user['nome']; ?>"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" value="<?php echo $user['cpf']; ?>" readonly><br>

        <label for="data_nascimento">Data de Nascimento:</label><br>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $user['data_nascimento']; ?>"><br><br>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>