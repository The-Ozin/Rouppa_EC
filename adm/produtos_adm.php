<?php
session_start();
@include('../layouts/navbar.php');
include('../connect.php');

if (!isset($_SESSION['adm_name'])) {
    header('Location: http://localhost/Rouppa_EC/welcome.php');
    exit();
}

if (isset($_GET['delete_product_id'])) {
    $productId = $_GET['delete_product_id'];
    $query = "DELETE FROM produto WHERE prod_id = '$productId'";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        .subtitulo{
            text-align: center;
            padding: 10px;
            padding-top: 20px;
            font-size: x-large;
        }
        h1 {
            color: rgb(215, 90, 90);
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
        <h2 class="subtitulo">Produtos Anunciados por Usuários</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Condição</th>
                    <th>Anunciador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                SELECT p.*, u.nome AS usuario_nome, GROUP_CONCAT(pf.foto) AS fotos
                FROM produto p
                LEFT JOIN usuario u ON p.fk_usuario_cpf = u.cpf
                LEFT JOIN produto_fotos pf ON p.prod_id = pf.prod_id
                WHERE p.fk_loja_cnpj IS NULL
                GROUP BY p.prod_id";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cadastrador_nome = $row['usuario_nome'];
                        echo "<tr>";
                        echo "<td><button class='btn btn-primary' onclick='showPhoto(" . $row['prod_id'] . ")'>Mostrar Foto</button></td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['descricao_']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['preco']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                        echo "<td>" . ($row['condicao_uso'] ? 'Novo' : 'Usado') . "</td>";
                        echo "<td>" . htmlspecialchars($cadastrador_nome) . "</td>";
                        echo "<td><button class='btn btn-danger' onclick='deleteProduct(" . $row['prod_id'] . ")'>Excluir</button>
                        <button class='btn btn-primary' onclick='openEditProductModal(" . $row['prod_id'] . ", \"" . htmlspecialchars($row['nome']) . "\", \"" . htmlspecialchars($row['descricao_']) . "\", \"" . htmlspecialchars($row['preco']) . "\", \"" . htmlspecialchars($row['categoria']) . "\", " . $row['condicao_uso'] . ", \"" . htmlspecialchars($row['estado_peca']) . "\")'>Editar</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="table-container">
        <h2 class="subtitulo">Produtos Anunciados por Lojas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Condição</th>
                    <th>Anunciador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "
                SELECT p.*, l.nome AS loja_nome, GROUP_CONCAT(pf.foto) AS fotos
                FROM produto p
                LEFT JOIN loja l ON p.fk_loja_cnpj = l.cnpj
                LEFT JOIN produto_fotos pf ON p.prod_id = pf.prod_id
                WHERE p.fk_usuario_cpf IS NULL
                GROUP BY p.prod_id";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cadastrador_nome = $row['loja_nome'];
                        echo "<tr>";
                        echo "<td><button class='btn btn-primary' onclick='showPhoto(" . $row['prod_id'] . ")'>Mostrar Foto</button></td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['descricao_']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['preco']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                        echo "<td>" . ($row['condicao_uso'] ? 'Usado' : 'Novo') . "</td>";
                        echo "<td>" . htmlspecialchars($cadastrador_nome) . "</td>";
                        echo "<td><button class='btn btn-danger' onclick='deleteProduct(" . $row['prod_id'] . ")'>Excluir</button>
                        <button class='btn btn-primary' onclick='openEditProductModal(" . $row['prod_id'] . ", \"" . htmlspecialchars($row['nome']) . "\", \"" . htmlspecialchars($row['descricao_']) . "\", \"" . htmlspecialchars($row['preco']) . "\", \"" . htmlspecialchars($row['categoria']) . "\", " . $row['condicao_uso'] . ", \"" . htmlspecialchars($row['estado_peca']) . "\")'>Editar</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum produto encontrado</td></tr>";
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



    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm" action="update_product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="prod_id" id="editProdId">
                        <div class="mb-3">
                            <label for="editNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editNome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="editDescricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="editDescricao" name="descricao_"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPreco" class="form-label">Preço</label>
                            <input type="number" step="0.01" class="form-control" id="editPreco" name="preco">
                        </div>
                        <div class="mb-3">
                            <label for="editCategoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control" id="editCategoria" name="categoria">
                        </div>
                        <div class="mb-3">
                            <label for="editCondicaoUso" class="form-label">Condição</label>
                            <select class="form-control" id="editCondicaoUso" name="condicao_uso">
                                <option value="1">Novo</option>
                                <option value="0">Usado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editEstadoPeca" class="form-label">Estado da Peça</label>
                            <textarea class="form-control" id="editEstadoPeca" name="estado_peca"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function showPhoto(prodId) {
            fetch(`get_product_photo.php?prod_id=${prodId}`)
                .then(response => response.blob())
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    document.getElementById('photo').src = url;
                    $('#photoModal').modal('show');
                })
                .catch(error => console.error('Error fetching photo:', error));
        }

        function deleteProduct(prodId) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação não pode ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?delete_product_id=" + prodId;
                }
            })
        }

        function openEditProductModal(prodId, nome, descricao, preco, categoria, condicaoUso, estadoPeca) {
            document.getElementById('editProdId').value = prodId;
            document.getElementById('editNome').value = nome;
            document.getElementById('editDescricao').value = descricao;
            document.getElementById('editPreco').value = preco;
            document.getElementById('editCategoria').value = categoria;
            document.getElementById('editCondicaoUso').value = condicaoUso;
            document.getElementById('editEstadoPeca').value = estadoPeca;
            $('#editProductModal').modal('show');
        }
    </script>


</body>
</html>
