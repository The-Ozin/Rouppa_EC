<!DOCTYPE html>
<html>
<head>
    <title>Lista e Edição de Usuários</title>
    <link rel="stylesheet" href="edição_usuario.css">
</head>
<body>
<div id="opcoes">
    <img src="../imagens/logo1.jpg" id="logo" onclick="window.location.href='/main_index/main_index.html'">
    <h2>Usuário</h2>
    <button>editar usuario</button>
    <button onclick="window.location.href='edição_brechó.php'">editar brechó</button>
    <br><br>
    <h2>Loja</h2>
    <button onclick="window.location.href='../loja/edição_loja.php'">editar Loja</button>
    <button onclick="window.location.href='../loja/edição_produto.php'">editar produto da loja</button>
    <br><br>
    <h2>Administrador</h2>
    <button onclick="window.location.href='../editar_adm.php'">editar adm</button><br><br>
    <button onclick="window.location.href='../../adm_main.php'">painel adm</button>
</div>

<h2>Lista de Usuários</h2>
<div id="tabela-scroll">
    <table id="mesa" border="1">
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Editar</th>
        </tr>
        <?php
        include("connect.php");
        $query = "SELECT * FROM usuario";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($usuario = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $usuario['cpf']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td id="op_mudar">
                        <form action="processar_edição.php" method="post">
                            <input type="hidden" name="cpf_original" value="<?php echo $usuario['cpf']; ?>">
                            Nome: <input id="cx_ipt" type="text" name="nome" ><br><br>
                            Email: <input id="cx_ipt" type="email" name="email" ><br><br>
                            Senha: <input id="cx_ipt" type="password" name="nova_senha"><br><br>
                            <input id="botão" type="submit" value="Salvar">
                            <br><br>
                        </form>
                        <form action="processar_edição.php" method="post">
                                <input type="hidden" name="excluir" value="1">
                                <input type="hidden" name="cpf" value="<?php echo $usuario['cpf']; ?>">
                                <input id="botão" type="submit" value="Excluir Usuário">
                            </form><br>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Nenhum usuário encontrado.";
        }
        ?>
    </table>
</div>
</body>
</html>
