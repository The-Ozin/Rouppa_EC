<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adm_main.css">
    <link rel="stylesheet" href="/main1.css">
    <title>adm page</title>
</head>
<body>

<div id="opções">
    <img src="./imagens/logo1.jpg" id="logo" onclick="window.location.href='../main_index/main_index.html'">
    <h2>Usuário</h2>
    <button onclick="pagUsuarioLogin()">editar usuario</button>
    <button onclick="pagUsuarioCadastro()">editar produtos usuario</button>
    <br><br>
    <h2>Loja</h2>
    <button onclick="pagLojaLogin()">editar Loja</button>
    <button onclick="pagLojaCadastro()">editar produto da loja</button>
    <br><br>
    <h2>Administrador</h2>
    <button onclick="pagAdmLogin()">editar adm</button>
</div>

<h2>Lista de Usuários</h2>
<ul>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "Simba8!#";
    $dbname = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nome"] . "</li>";
        }
    } else {
        echo "Nenhum usuário encontrado";
    }

    $conn->close();
    ?>
</ul>

</body>
</html>
