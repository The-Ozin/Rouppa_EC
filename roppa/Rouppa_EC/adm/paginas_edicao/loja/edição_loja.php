<!DOCTYPE html>
<html>
<head>
    <title>Edição de Lojas</title>
    <link rel="stylesheet" href="edição_lojas.css">
</head>
<body>
<div id="opcoes">
        <img src="../imagens/logo1.jpg"  id="logo" onclick="window.location.href='/main_index/main_index.html'">
        <h2>Usuário</h2>
        <button onclick="window.location.href='../usuario/edição_usuario.php'">editar usuario</button>
        <button onclick="window.location.href='./usuario/edição_brechó'">editar brechó</button>
        <br><br>
        <h2>Loja</h2>
        <button >editar Loja</button>
        <button onclick="window.location.href='edição_produto.php'">editar produto da loja</button>
        <br><br>
        <h2>Administrador</h2>
        <button onclick="window.location.href='../editar_adm.php'">editar adm</button><br><br>

        <button onclick="window.location.href='../../adm_main.php'">painel adm</button>
    </div>

<h2>Lista de Lojas</h2>
<div id="tabela-scroll">
    <table id="mesa" border="1">
        <tr>
            <th>CNPJ</th>
            <th>Nome da Loja</th>
            <th>Email Comercial</th>
            <th>CEP</th>
            <th>Editar</th>
        </tr>
        <?php
        include("connect.php");
        $query = "SELECT * FROM loja";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($loja = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $loja['cnpj']; ?></td>
                    <td><?php echo $loja['nome_loja']; ?></td>
                    <td><?php echo $loja['email_comercial']; ?></td>
                    <td><?php echo $loja['cep']; ?></td>
                    <td id="op_mudar">
                        <form action="processar_edicao_loja.php" method="post">
                            <input type="hidden" name="cnpj_original" value="<?php echo $loja['cnpj']; ?>">
                            Nome: <input id="cx_ipt" type="text" name="nome_loja" value=""><br><br>
                            Email Comercial: <input id="cx_ipt" type="email" name="email_comercial" value=""><br><br>
                            CEP: <input id="cx_ipt" type="text" name="cep" value=""><br><br>
                            <input id="botão" type="submit" value="Salvar">
                            <br><br>
                        </form>
                        <form action="processar_edicao_loja.php" method="post">
                                <input type="hidden" name="excluir" value="1">
                                <input type="hidden" name="cnpj" value="<?php echo $loja['cnpj']; ?>">
                                <input id="botão" type="submit" value="Excluir Loja">
                        </form><br>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Nenhuma loja encontrada.";
        }
        ?>
    </table>
</div>
</body>
</html>
