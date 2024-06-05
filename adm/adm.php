<?php
session_start();
@include('../layouts/navbar.php');
include('../connect.php');

if (!isset($_SESSION['adm_name'])) {
    header('Location: http://localhost/Rouppa_EC/welcome.php');
    exit();
}


if (isset($_GET['delete_user_cpf'])) {
    $userCpf = $_GET['delete_user_cpf'];


    $deleteProdutoQuery = "DELETE FROM produto WHERE fk_usuario_cpf = '$userCpf'";
    mysqli_query($conn, $deleteProdutoQuery);

  
    $deletePedidoQuery = "DELETE FROM pedido WHERE fk_usuario_cpf = '$userCpf'";
    mysqli_query($conn, $deletePedidoQuery);

    $deleteUsuarioQuery = "DELETE FROM usuario WHERE cpf = '$userCpf'";
    mysqli_query($conn, $deleteUsuarioQuery);


    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Usuário deletado com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'sua_pagina.php'; // Redireciona para uma página específica
                    }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao deletar usuário.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'sua_pagina.php'; // Redireciona para uma página específica
                    }
                });
              </script>";
    }
}



if (isset($_GET['delete_store_cnpj'])) {
    $storeCnpj = $_GET['delete_store_cnpj'];


    $deleteProdutoQuery = "DELETE FROM produto WHERE fk_loja_cnpj = '$storeCnpj'";
    mysqli_query($conn, $deleteProdutoQuery);


    $deleteLojaQuery = "DELETE FROM loja WHERE cnpj = '$storeCnpj'";
    mysqli_query($conn, $deleteLojaQuery);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Loja deletada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'sua_pagina.php'; // Redireciona para uma página específica
                    }
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao deletar loja.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'sua_pagina.php'; // Redireciona para uma página específica
                    }
                });
              </script>";
    }
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
        .subtitulo{
            text-align: center;
            padding: 10px;
            padding-top: 20px;
            font-size: x-large;
        }
        h1 {
            color: rgb(215,90, 90);
            text-align: center;
            margin-top: -10vh;
            font-weight: bold;
            font-family: 'Noto Serif Display', serif;
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

    <div class="table-container">
        <h2 class="subtitulo">Usuários</h2>
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
                        echo "<td><button class='btn btn-primary' onclick='showPhoto(\"" . $row['foto'] . "\")'>Mostrar Foto</button></td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['data_nascimento']) . "</td>";
                        echo "<td><button class='btn btn-danger' onclick='deleteUser(\"" . $row['cpf'] . "\")'>Excluir</button>
                        <button class='btn btn-primary' onclick='openEditUserModal(\"" . $row['cpf'] . "\", \"" . htmlspecialchars($row['nome']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['data_nascimento']) . "\", \"" . $row['foto'] . "\")'>Editar</button></td>";
                        echo "</tr>";
                    }
                } 
                
                else {
                    echo "<tr><td colspan='6'>Nenhum usuário encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div> 


        <div id="photoModal" class="modal fade" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="photoModalLabel">Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="photo" src="" alt="Foto" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 


        <div class="table-container">
            <h2 class="subtitulo">Lojas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
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
                            echo "<td><button class='btn btn-primary' onclick='showPhoto(\"" . $row['foto'] . "\")'>Mostrar Foto</button></td>";
                            echo "<td>" . htmlspecialchars($row['cnpj']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['endereco']) . "</td>";
                            echo "<td><button class='btn btn-danger' onclick='deleteStore(\"" . $row['cnpj'] . "\")'>Excluir</button>
                            <button class='btn btn-primary' onclick='openEditStoreModal(\"" . $row['cnpj'] . "\", \"" . htmlspecialchars($row['nome']) . "\", \"" . htmlspecialchars($row['endereco']) . "\", \"" . $row['foto'] . "\")'>Editar</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhuma loja encontrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" action="update_user.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Editar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="1">
                        <input type="hidden" name="cpf" id="editCpf">
                        <div class="mb-3">
                            <label for="editNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editNome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editDataNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="editDataNascimento" name="data_nascimento">
                        </div>
                        <div class="mb-3">
                            <label for="editFoto" class="form-label">Foto</label>
                            <input type="text" class="form-control" id="editFoto" name="foto">
                        </div>
                        <img id="editFotoPreview" src="" alt="Foto do usuário" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editStoreModal" tabindex="-1" aria-labelledby="editStoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editStoreForm" action="update_user.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStoreModalLabel">Editar Loja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="2">
                        <input type="hidden" name="cnpj" id="editStoreCnpj">
                        <div class="mb-3">
                            <label for="editStoreNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editStoreNome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="editStoreEndereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="editStoreEndereco" name="endereco">
                        </div>
                        <div class="mb-3">
                            <label for="editStoreFoto" class="form-label">Foto</label>
                            <input type="text" class="form-control" id="editStoreFoto" name="foto">
                        </div>
                        <img id="editStoreFotoPreview" src="" alt="Foto da loja" class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <?php include('../layouts/footer.php'); ?>
    </footer>
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

        function openEditUserModal(cpf, nome, email, dataNascimento, foto) {
            document.getElementById('editCpf').value = cpf;
            document.getElementById('editNome').value = nome;
            document.getElementById('editEmail').value = email;
            document.getElementById('editDataNascimento').value = dataNascimento;
            document.getElementById('editFoto').value = foto;
            document.getElementById('editFotoPreview').src = foto;
            var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editUserModal.show();
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

        function openEditStoreModal(cnpj, nome, endereco, foto) {
            document.getElementById('editStoreCnpj').value = cnpj;
            document.getElementById('editStoreNome').value = nome;
            document.getElementById('editStoreEndereco').value = endereco;
            document.getElementById('editStoreFoto').value = foto;
            document.getElementById('editStoreFotoPreview').src = foto;
            var editStoreModal = new bootstrap.Modal(document.getElementById('editStoreModal'));
            editStoreModal.show();
        }

        function showPhoto(photoUrl) {
            document.getElementById('photo').src = photoUrl;
            var photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
            photoModal.show();
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
