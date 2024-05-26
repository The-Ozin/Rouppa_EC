<?php 
include('../connect.php');

// Função para deletar usuário
if (isset($_GET['delete_user_cpf'])) {
    $userCpf = $_GET['delete_user_cpf'];
    $query = "DELETE FROM usuario WHERE cpf = '$userCpf'";
    mysqli_query($conn, $query);
}

// Função para deletar loja
if (isset($_GET['delete_store_cnpj'])) {
    $storeCnpj = $_GET['delete_store_cnpj'];
    $query = "DELETE FROM loja WHERE cnpj = '$storeCnpj'";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link rel="stylesheet" href="../assets/style.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        h1 {
            color: rgb(215,90, 90);
            text-align: center;
            margin-top: -10vh;
            font-weight: bold;
        }
        img {
            width: 200px;
            height: 200px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20vh;
            transform: translateY(-50%);
        }
        .container {
            margin-top: 20px;
        }
        .table-container {
            margin: 20px auto;
            width: 80%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <a href="../welcome.php"><img src="../assets/images/logo1.jpg" alt="Rouppa"></a>
    <h1>Administração da Rouppa</h1>

    <div class="container">
        <div class="table-container">
            <h2>Usuários</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM usuario";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><img src='" . $row['foto'] . "' alt='Foto do usuário'></td>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['data_nascimento']) . "</td>";
                            echo "<td><button class='btn btn-danger' onclick='deleteUser(\"" . $row['cpf'] . "\")'>Excluir</button>
                            <button class='btn btn-primary' onclick='editUser(\"" . $row['cpf'] . "\")'>Editar</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum usuário encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <h2>Lojas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>CNPJ</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM loja";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['cnpj']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['endereco']) . "</td>";
                            echo "<td><button class='btn btn-danger' onclick='deleteStore(\"" . $row['cnpj'] . "\")'>Excluir</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Nenhuma loja encontrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function deleteUser(userCpf) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?delete_user_cpf=" + userCpf;
                }
            });
        }

        function editUser(userId) {
            window.location.href = "edit_user.php?id"
        }


        function editUser(userId) {
   
            window.location.href = "edit_user.php?id=" + userId;
        }


        function deleteStore(storeCnpj) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?delete_store_cnpj=" + storeCnpj;
                }
            });
        }
    </script>
</body>
</html>

