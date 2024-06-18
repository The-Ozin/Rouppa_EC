<?php
session_start();
@include('../checarInatividade.php');
checarInatividade();
include('../connect.php');

if (!isset($_SESSION['user_name']) && !isset($_SESSION['nome_loja'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}

@include('../layouts/navbar.php');

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$ordem = isset($_GET['ordem']) ? $_GET['ordem'] : '';
$tamanho = isset($_GET['tamanho']) ? $_GET['tamanho'] : '';

$query = "SELECT * FROM produto WHERE 1";
$query = "SELECT * FROM produto WHERE tipo_usuario = 'loja'";
if ($categoria) {
    $query .= " AND categoria = '" . mysqli_real_escape_string($conn, $categoria) . "'";
}

if ($tamanho) {
    $query .= " AND tamanho = '" . mysqli_real_escape_string($conn, $tamanho) . "'";
}

if ($ordem == 'preco_asc') {
    $query .= " ORDER BY preco ASC";
} elseif ($ordem == 'preco_desc') {
    $query .= " ORDER BY preco DESC";
}

$result = mysqli_query($conn, $query);
if ($result === false) {
    die("Error executing query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rouppa</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1 class="centralize">Produtos</h1>

    <form method="GET" action="" class="product-filter" style="width: 1500px; height: 200px;">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" onchange="toggleTamanhoInputs()">
            <option value="">Todas</option>
            <option value="calcado" <?php if ($categoria == 'calcado') echo 'selected'; ?>>Calçado</option>
            <option value="roupa" <?php if ($categoria == 'roupa') echo 'selected'; ?>>Roupa</option>
            <option value="acessorio" <?php if ($categoria == 'acessorio') echo 'selected'; ?>>Acessório</option>
        </select>

        <div id="tamanhoInputs" style="display: none;">
            <label for="tamanho">Tamanho:</label>
            <select name="tamanho" id="tamanho" onchange="showSizes()">
                <option value="">Selecione</option>
                <option value="roupa">Roupa</option>
                <option value="calcado">Calçado</option>
            </select>
        </div>

        <label for="ordem">Ordenar por:</label>
        <select name="ordem" id="ordem">
            <option value="">Selecione</option>
            <option value="preco_asc" <?php if ($ordem == 'preco_asc') echo 'selected'; ?>>Menor preço</option>
            <option value="preco_desc" <?php if ($ordem == 'preco_desc') echo 'selected'; ?>>Maior preço</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="d-flex justify-content-center flex-wrap">';

        while ($row = mysqli_fetch_assoc($result)) {
                $foto_query = "SELECT foto FROM produto_fotos WHERE prod_id = " . $row['prod_id'];
                $foto_result = mysqli_query($conn, $foto_query);

                echo '<div class="product-card">';
                echo '<div id="carouselExampleControls' . $row['prod_id'] . '" class="carousel slide" data-bs-ride="carousel">';
                echo '<div class="carousel-inner">';
                $active = true;

                while ($foto_row = mysqli_fetch_assoc($foto_result)) {
                    echo '<div class="carousel-item' . ($active ? ' active' : '') . '">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($foto_row['foto']) . '" class="d-block w-100" alt="Produto ' . $row['nome'] . '">';
                    echo '</div>';
                    $active = false;
                }

                echo '</div>';
                echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls' . $row['prod_id'] . '" data-bs-slide="prev">';
                echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Previous</span>';
                echo '</button>';
                echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls' . $row['prod_id'] . '" data-bs-slide="next">';
                echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Next</span>';
                echo '</button>';
                echo '</div>';

                echo '<div class="product-details">';
                echo '<h5>' . htmlspecialchars($row['nome']) . '</h5>';
                echo '<p>' . htmlspecialchars($row['descricao_']) . '</p>';
                echo '</p>';
                echo '<span>Tamanho: ' . htmlspecialchars($row['tamanho']) . '</span>';
                echo '</p>';
                echo '<p style="float: right;">Preço: R$ ' . htmlspecialchars($row['preco']) . '</p>';
                echo '</p>';
                if (isset($_SESSION['user_name'])){
                    echo '<button class="add-to-cart btn btn-primary mt-3" data-id="' . $row['prod_id'] . '" data-tipo="loja">Adicionar ao Carrinho</button>';
                }
                echo '</div>';
                echo '</div>';
            }


        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>Nenhum produto encontrado</p>';
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleTamanhoInputs() {
            const categoria = document.getElementById('categoria').value;
            const tamanhoInputs = document.getElementById('tamanhoInputs');
            const tamanhoSelect = document.getElementById('tamanho');

            if (categoria === 'roupa' || categoria === 'calcado') {
                tamanhoInputs.style.display = 'inline-block';
            } else {
                tamanhoInputs.style.display = 'none';
            }

            if (categoria === 'roupa') {
                tamanhoSelect.innerHTML = '';
                ['PP','P', 'M', 'G', 'GG'].forEach(size => {
                    tamanhoSelect.innerHTML += `<option value="${size}">${size}</option>`;
                });
            } else if (categoria === 'calcado') {
                tamanhoSelect.innerHTML = '';
                for (let i = 28; i <= 45; i++) {
                    tamanhoSelect.innerHTML += `<option value="${i}">${i}</option>`;
                };
            } else {
                tamanhoSelect.innerHTML = '';
            }
        }

        document.addEventListener('DOMContentLoaded', toggleTamanhoInputs);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();

                var prodId = $(this).data('id');
                var tipoUsuario = $(this).data('tipo');

                $.ajax({
                    type: 'POST',
                    url: '../product/add_to_cart.php',
                    data: { prod_id: prodId, tipo_usuario: tipoUsuario },
                    success: function(response) {
                        if (response === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Adicionado!',
                                text: 'Produto adicionado ao carrinho com sucesso.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro',
                                text: 'Erro ao adicionar o produto ao carrinho.'
                            });
                        }
                    }
                });
            });
        });
    </script>
    <footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>
</body>
</html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

footer {
    margin-top: 25px;
}

.carousel {
    margin-top: 10vh;
    width: 400px !important;
    height: 400px !important;
    position: relative; /* Adicionado para garantir que os elementos filhos sejam posicionados corretamente */
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: transparent; /* Removendo qualquer cor de fundo */
    background-image: none; /* Removendo qualquer imagem de fundo */
    border: none; /* Removendo qualquer borda */
}

.carousel-control-prev,
.carousel-control-next {
    filter: invert(1); /* Inverte a cor das setas para preto */
    opacity: 1; /* Garante que as setas sejam completamente opacas */
}

.d-block {
    width: 100%; /* Ajusta a largura para 100% do contêiner pai */
    height: 100%; /* Ajusta a altura para 100% do contêiner pai */
    object-fit: contain; /* Garante que a imagem seja completamente visível */
}

h1 {
    margin-top: 10vh;
    font-family: 'Anton', sans-serif;
    color: rgb(90, 29, 0);
    text-align: center;
}
.product-filter {
    display: flex;
    align-items: center;
    margin-bottom: 20px; /* Ajustando a margem inferior */
    background-color: transparent; /* Fundo transparente */
    padding: 0; /* Removendo espaçamento interno */
    border-radius: 0; /* Removendo cantos arredondados */
    box-shadow: none; /* Removendo sombra */
    margin-left: 12vh;
    font-size: 20px;
}

.product-filter label,
.product-filter select {
    margin-right: 10px;
    font-family: 'Roboto', sans-serif; /* Fonte moderna */
    color: rgb(90, 29, 0); /* Cor do texto */
}

.product-filter select {
    padding: 8px 12px; /* Espaçamento interno */
    border: 2px solid rgb(215, 90, 90); /* Borda com cor temática */
    border-radius: 4px; /* Cantos arredondados */
    background-color: #fff; /* Fundo branco */
    color: rgb(215, 90, 90); /* Cor do texto */
    cursor: pointer;
    transition: border-color 0.3s; /* Transição suave para mudanças */
}

.product-filter select:hover,
.product-filter select:focus {
    border-color: #a83232; /* Cor de borda ao focar/passar o mouse */
    outline: none; /* Remover contorno padrão */
}

.product-filter button {
    padding: 8px 16px;
    background-color: rgb(215, 90, 90); /* Cor de fundo temática */
    color: #fff; /* Cor do texto branco */
    border: none;
    border-radius: 4px; /* Cantos arredondados */
    cursor: pointer;
    font-family: 'Roboto', sans-serif; /* Fonte moderna */
    transition: background-color 0.3s; /* Transição suave para mudanças */
}

.product-filter button:hover {
    background-color: #a83232; /* Cor de fundo ao passar o mouse */
}

.product-card {
    padding: 20px; /* Ajustando padding para espaço interno */
    height: auto; /* Ajustando altura conforme o conteúdo */
    margin: 50px;
    border-radius: 8px; /* Cantos arredondados */
    background-color: #fff; /* Fundo branco */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para destacar */
    overflow: hidden; /* Garantir que conteúdo extra não vaze */
    transition: transform 0.3s; /* Transição suave para mudanças */
    display: flex;
    flex-direction: column;
    align-items: center; /* Centralizando elementos no eixo vertical */
    justify-content: space-between; /* Espaçando conteúdo uniformemente */
}

.product-card:hover {
    transform: scale(1.05); /* Efeito de zoom ao passar o mouse */
}

.add-to-cart {
    padding: 10px 20px;
    background-color: rgb(215, 90, 90); /* Cor de fundo do botão */
    color: #fff; /* Cor do texto */
    border: none;
    border-radius: 4px; /* Cantos arredondados */
    cursor: pointer;
    transition: background-color 0.3s; /* Transição suave para mudanças */
    align-self: center; /* Centraliza o botão no card */
}

.add-to-cart:hover {
    background-color: #a83232; /* Cor de fundo ao passar o mouse */
}

</style>