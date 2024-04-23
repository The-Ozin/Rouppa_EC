<!DOCTYPE html>
<html>
<head>
    <title>Lista e Edição de Usuários</title>
    <link rel="stylesheet" href="edição_usuario.css">
</head>
<body>
<div id="opcoes">
        <img src="/adm/imagens/logo1.jpg" id="logo" onclick="window.location.href='../main_index/main_index.html'">
        <h2>Usuário</h2>
        <button onclick="window.location.href='./paginas_edicao/usuario/edição_usuario.php'">editar usuario</button>
        <button onclick="window.location.href='./paginas_edicao/usuario/edição_brechó.php'">editar brechó</button>
        <br><br>
        <h2>Loja</h2>
        <button onclick="window.location.href='./paginas_edicao/loja/edição_loja.php'">editar Loja</button>
        <button onclick="window.location.href='./paginas_edicao/loja/edição_produto.php'">editar produto da loja</button>
        <br><br>
        <h2>Administrador</h2>
        <button onclick="window.location.href='./paginas_edicao/editar_adm.php'">editar adm</button>
    </div>

<h2>Lista de Usuários</h2>
<div id="table-scroll">
    <table id="mesa" border="1">
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Email</th>

            <th>Editar</th>
        </tr>
        <?php

        include ("connect.php");
        $query = "SELECT * FROM usuario";
        $result = $conn->query($query);
        $user = array();

        if ($result->num_rows > 0) {

            while ($user = $result->fetch_assoc()) {
                ?>
                <tr>

                    <td><?php echo $user['cpf']; ?></td>

                    <td><?php echo $user['nome']; ?></td>

                    <td><?php echo $user['email']; ?></td>



                    <td id="op_mudar">
                        <form action="processar_edição.php" method="post">



                            <!-- Campo oculto para enviar o CPF original do usuário -->
                            <input type="hidden" name="cpf_original" value="<?php echo $user['cpf']; ?>">
                            <!-- Campo para editar o CPF do usuário -->
                            CPF: <input id="cx_ipt" type="text" name="cpf_novo" value=""><br><br>
                            <!-- Campo para editar o nome do usuário -->
                            Nome: <input id="cx_ipt" type="text" name="nome" value=""><br><br>
                            <!-- Campo para editar o email do usuário -->
                            Email: <input id="cx_ipt" type="email" name="email" value=""><br><br>
                            <!-- Botão para enviar o formulário -->
                            <input id="botão" type="submit" value="Salvar">
                            <br><br>
                            <form action="processar_edição.php" method="post">
                                    <input type="hidden" name="excluir" value="1">
                                    <input type="hidden" name="cpf" value="<?php echo $user['cpf']; ?>">
                                    <input id="botão" type="submit" value="Excluir usuario">
                                    
                            </form><br>

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
</div>

</body>
</html>
