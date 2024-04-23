<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adm_main.css">
    <title>adm pagina</title>
<style>
    ul{color: white;}
</style>
</head>
<body>

    <div id="opcoes">
        <img src="./imagens/logo1.jpg" id="logo" onclick="window.location.href='../main_index/main_index.html'">
        <h2>Usuário</h2>
        <button onclick="window.location.href='./paginas_edição/usuario/edição_usuario.php'">editar usuario</button>
        <button onclick="window.location.href='./paginas_edição/usuario/edição_brechó.php'">editar brechó</button>
        <br><br>
        <h2>Loja</h2>
        <button onclick="window.location.href='./paginas_edição/loja/edição_loja.php'">editar Loja</button>
        <button onclick="window.location.href='./paginas_edição/loja/edição_produto.php'">editar produto da loja</button>
        <br><br>
        <h2>Administrador</h2>
        <button onclick="window.location.href='./paginas_edição/editar_adm.php'">editar adm</button>
    </div>


    <div  class="listas scrollable" id="lista_usuario">
        <h2 id="titulo1">Lista de Usuários</h2>
        <ul>
            <?php
                include "../connect.php";

                $sql = "SELECT * FROM usuario";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["nome"]. "    /    " .$row["cpf"]. "</li>";
                    }
                } else {
                    echo "Nenhum usuário encontrado";
                }

            ?>
        </ul>
    </div>

    <div class="listas scrollable" id="lista_loja">
        <h2 id="titulo2">Lista de lojas</h2>
        <ul>
            <?php
                include "../connect.php";

                $sql = "SELECT * FROM loja";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["nome_loja"]."    /    ".$row["cnpj"] . "</li>";
                    }
                } else {
                    echo "Nenhuma loja encontrada";
                }

            ?>
        </ul>
    </div>

    <div class="listas scrollable" id="lista_adm">

        <ul>
            <h2 id="titulo3">Lista de adms</h2>
            <?php
                include "../connect.php";

                $sql = "SELECT * FROM adm";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["id_adm"]."    /    ".$row["cpf"] . "</li>";
                    }
                } else {
                    echo "Nenhum usuário encontrado";
                }

            ?>
        </ul>
    </div>
    
</body>
</html>
