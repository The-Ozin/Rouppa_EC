<!DOCTYPE html>
<html>
<head>
    <title>Lista e Edição de Usuários</title>
</head>
<body>

<h2>Lista de Usuários</h2>

<table id="mesa" border="1">
    <tr>
        <th>CPF</th>
        <th>Nome</th>
        <th>Email</th>

        <th>Editar</th>
    </tr>
    <?php
    // Inclui o arquivo de conexão com o banco de dados
    include ("./connect.php");
    // Consulta SQL para selecionar todos os usuários
    $query = "SELECT * FROM usuario";
    // Executa a consulta SQL
    $result = $conn->query($query);
    $user = array();

    if ($result->num_rows > 0) {

        while ($user = $result->fetch_assoc()) {
            ?>
            <tr>

                <td><?php echo $user['cpf']; ?></td>

                <td><?php echo $user['nome']; ?></td>

                <td><?php echo $user['email']; ?></td>



                <td>
                    <form action="processar_edição.php" method="post">


                        <form id="botão_excluir" action="processar_edição.php" method="post">
                                <input type="hidden" name="excluir" value="1">
                                <input type="hidden" name="cpf" value="<?php echo $user['cpf']; ?>">
                                <input type="submit" value="Excluir usuario">
                                
                        </form>
                        <!-- Campo oculto para enviar o CPF original do usuário -->
                        <input type="hidden" name="cpf_original" value="<?php echo $user['cpf']; ?>">
                        <!-- Campo para editar o CPF do usuário -->
                        CPF: <input type="text" name="cpf_novo" value=""><br>
                        <!-- Campo para editar o nome do usuário -->
                        Nome: <input type="text" name="nome" value=""><br>
                        <!-- Campo para editar o email do usuário -->
                        Email: <input type="email" name="email" value=""><br>
                        <!-- Botão para enviar o formulário -->
                        <input type="submit" value="Salvar">

                    </form>
                </td>


            </tr>
            
            <?php
        }
    } else {

        echo "Nenhum usuário encontrado.";
    }
    ?>
</table>

</body>
</html>
