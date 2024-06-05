<?php
session_start();

include('../connect.php');
if (!isset($_SESSION['user_name'])) {
    header('Location: http://localhost/Rouppa_EC/user/user_login.php');
    exit();
}
@include('../layouts/navbar.php');
$cpf = $_SESSION['cpf'];

if (isset($_GET['delete_product_id'])) {
    $productId = $_GET['delete_product_id'];
    $query = "DELETE FROM produto WHERE prod_id = '$productId' AND fk_usuario_cpf = '$cpf'";
    mysqli_query($conn, $query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
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
    <style>
        h1 {
            color: rgb(215, 90, 90);
            text-align: center;
            margin-top: 5vh;
            font-weight: bold;
            font-family: 'Noto Serif Display', serif;
        }
        .logo {
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

    <a href="../welcome.php"><img src="../assets/images/logo1.jpg" alt="Rouppa" class="logo"></a>
    <h1>Gerenciamento de Produtos</h1>
    <div class="table-container">
        <h2>Produtos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Tamanho</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Condição de Uso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM produto WHERE fk_usuario_cpf = '$cpf'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tamanho']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['preco']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['descricao_']) . "</td>";
                        echo "<td>" . ($row['condicao_uso'] ? 'Novo' : 'Usado') . "</td>";
                        echo "<td><button class='btn btn-danger' onclick='deleteProduct(\"" . $row['prod_id'] . "\")'>Excluir</button>
                        <button class='btn btn-primary' onclick='openEditProductModal(\"" . $row['prod_id'] . "\", \"" . htmlspecialchars($row['nome']) . "\", \"" . htmlspecialchars($row['categoria']) . "\", \"" . htmlspecialchars($row['tamanho']) . "\", \"" . htmlspecialchars($row['preco']) . "\", \"" . htmlspecialchars($row['descricao_']) . "\", \"" . htmlspecialchars($row['condicao_uso']) . "\")'>Editar</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editProductForm" action="edit_product.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="prod_id" id="editProductId">
                        <div class="mb-3">
                            <label for="editProductNome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editProductNome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategoria" class="form-label">Categoria</label>
                            <select class="form-select" id="editProductCategoria" name="categoria" onchange="populateSizeDropdown(this.value)">
                                <option value="Roupa">Roupa</option>
                                <option value="Calçado">Calçado</option>
                                <option value="Acessório">Acessório</option>
                            </select>
                        </div>
                        <div class="mb-3" id="tamanhoDropdown">
                            <label for="editProductTamanho" class="form-label">Tamanho</label>
                            <select class="form-select" id="editProductTamanho" name="tamanho">
                                <option value="">Selecione a categoria primeiro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPreco" class="form-label">Preço</label>
                            <input type="text" class="form-control" id="editProductPreco" name="preco">
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescricao" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="editProductDescricao" name="descricao">
                        </div>
                        <div class="mb-3">
                            <label for="editProductCondicao" class="form-label">Condição</label>
                            <select class="form-control" id="editProductCondicao" name="condicao">
                                <option value="1">Novo</option>
                                <option value="0">Usado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteProduct(productId) {
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
                    window.location.href = "?delete_product_id=" + productId;
                }
            });
        }

        function openEditProductModal(id, nome, categoria, tamanho, preco, descricao, condicao) {
            document.getElementById('editProductId').value = id;
            document.getElementById('editProductNome').value = nome;
            document.getElementById('editProductCategoria').value = categoria;
            document.getElementById('editProductTamanho').value = tamanho;
            document.getElementById('editProductPreco').value = preco;
            document.getElementById('editProductDescricao').value = descricao;
            document.getElementById('editProductCondicao').value = condicao;
            var editProductModal = new mdb.Modal(document.getElementById('editProductModal'));
            editProductModal.show();
        }

        function populateSizeDropdown(categoria) {
            var tamanhoDropdown = document.getElementById('tamanhoDropdown');
            var tamanhoSelect = document.getElementById('editProductTamanho');
            tamanhoSelect.innerHTML = ''; 

            if (categoria === 'Roupa') {
                var sizes = ["PP", "P", "M", "G", "GG"];
                sizes.forEach(function(size) {
                    var option = document.createElement("option");
                    option.text = size;
                    option.value = size;
                    tamanhoSelect.appendChild(option);
                });
            } else if (categoria === 'Calçado') {
                for (var i = 25; i <= 45; i++) {
                    var option = document.createElement("option");
                    option.text = i.toString();
                    option.value = i.toString();
                    tamanhoSelect.appendChild(option);
                }
            } else {
                tamanhoDropdown.style.display = 'none';
            }
        }

    </script>

</body>
<footer>
        <?php include('../layouts/footer.php'); ?>
</footer>
</html>