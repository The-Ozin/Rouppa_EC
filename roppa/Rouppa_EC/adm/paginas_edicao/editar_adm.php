<!DOCTYPE html>
<html>
<head>
    <title>Lista e Edição de Administradores</title>
    <link rel="stylesheet" href="editar_adm.css">
</head>
<body>
<div id="opcoes">
    <img src="../imagens/logo1.jpg" id="logo" onclick="window.location.href='/main_index/main_index.html'">
    <h2>Administrador</h2>
    <button onclick="window.location.href='usuario/edição_usuario.php'">editar usuario</button>
    <button onclick="window.location.href='usuario/edição_brechó.php'">editar brechó</button>
    <br><br>
    <h2>Loja</h2>
    <button onclick="window.location.href='loja/edição_loja.php'">editar Loja</button>
    <button onclick="window.location.href='loja/edição_produto.php'">editar produto da loja</button><br><br>
    <button onclick="window.location.href='../adm_main.php'">painel adm</button>
</div>

<h2>Lista de Administradores</h2>
<div id="tabela-scroll">
    <table id="mesa" border="1">
        <tr>
            <th>ID</th>
            <th>CPF</th>
            <th>Editar</th>
        </tr>
        <?php
        include("connect.php");
        $query = "SELECT * FROM adm";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($adm = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $adm['id_adm']; ?></td>
                    <td><?php echo $adm['cpf']; ?></td>
                    <td id="op_mudar">
                        <form action="processar_edicao_adm.php" method="post">
                            <input type="hidden" name="id_adm" value="<?php echo $adm['id_adm']; ?>">
                            CPF: <input id="cx_ipt" type="text" name="cpf"><br><br>
                            Senha: <input id="cx_ipt" type="password" name="senha" value=""><br><br>
                            <input id="botão" type="submit" value="Salvar">
                        </form>
                        <form action="processar_edicao_adm.php" method="post">
                            <input type="hidden" name="excluir" value="1">
                            <input type="hidden" name="id_adm" value="<?php echo $adm['id_adm']; ?>">
                            <input id="botão" type="submit" value="Excluir Administrador">
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Nenhum administrador encontrado.";
        }
        ?>
    </table>
</div>
</body>
</html>
