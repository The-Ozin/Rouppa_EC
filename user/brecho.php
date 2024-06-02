<?php
session_start();
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
$query = "SELECT * FROM produto WHERE tipo_usuario = 'usuario'";
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
   <!-- Font Awesome -->
   <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
    rel="stylesheet"
    />

    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
    "></script>

        <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"
        
        initMDB({ Input, Tab, Ripple });
    ></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="sale"> ! 20% OFF EM TODA A COMPRA ! </div>
    <h1 class="centralize">Produtos</h1>

    <!-- Formulário de Filtros -->
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
            // Consulta para obter as fotos do produto
            $foto_query = "SELECT foto FROM produto_fotos WHERE prod_id = " . $row['prod_id'];
            $foto_result = mysqli_query($conn, $foto_query);

            // Iniciar o carrossel
            echo '<div class="product-card">';
            echo '<div id="carouselExampleControls' . $row['prod_id'] . '" class="carousel slide" data-bs-ride="carousel">';
            echo '<div class="carousel-inner">';
            $active = true;

            // Iterar sobre cada foto e adicionar ao carrossel
            while ($foto_row = mysqli_fetch_assoc($foto_result)) {
                echo '<div class="carousel-item' . ($active ? ' active' : '') . '">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($foto_row['foto']) . '" class="d-block w-100" alt="Produto ' . $row['nome'] . '">';
                echo '</div>';
                $active = false;
            }

            // Finalizar o carrossel
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

            // Exibir os detalhes do produto abaixo do carrossel
            echo '<div class="product-details">';
            echo '<h5>' . htmlspecialchars($row['nome']) . '</h5>';
            echo '<p>' . htmlspecialchars($row['descricao_']) . '</p>';
            echo '<p>';
            echo '<span>Tamanho: ' . htmlspecialchars($row['tamanho']) . '</span>';
            echo '<span style="float: right;">Preço: R$ ' . htmlspecialchars($row['preco']) . '</span>';
            echo '</p>';
            echo '<form action="http://localhost/Rouppa_EC/product/add_to_cart.php" method="post">';
            echo '<input type="hidden" name="prod_id" value="' . $row['prod_id'] . '">';
            echo '<button type="submit" class="btn btn-primary mt-3">Adicionar ao Carrinho</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>Nenhum produto encontrado</p>';
    }
    ?>
<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleTamanhoInputs() {
            const categoria = document.getElementById('categoria').value;
            const tamanhoInputs = document.getElementById('tamanhoInputs');
            const tamanhoSelect = document.getElementById('tamanho');

            if (categoria === 'roupa' || categoria === 'calcado') {
                tamanhoInputs.style.display = 'inline-block'; // Adjust display property
            } else {
                tamanhoInputs.style.display = 'inline-block';
            }

            if (categoria === 'roupa') {
                tamanhoSelect.innerHTML = ''; // Clear existing options
                ['P', 'M', 'G', 'GG'].forEach(size => {
                    tamanhoSelect.innerHTML += `<option value="${size}">${size}</option>`;
                });
            } else if (categoria === 'calcado') {
                tamanhoSelect.innerHTML = ''; // Clear existing options
                for (let i = 28; i <= 45; i++) {
                    tamanhoSelect.innerHTML += `<option value="${i}">${i}</option>`;
                }
            } else {
                tamanhoSelect.innerHTML = ''; // Clear existing options
            }
        }

        document.addEventListener('DOMContentLoaded', toggleTamanhoInputs);

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
    margin-top: 40vh;
}

    .sale {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: orangered;
        font-family: 'Anton', sans-serif;
        color: black;
        font-weight: 400;
        font-size: 80px;
        height: 200px;
        width: 100%;
        margin: 0;
        position: absolute;
        top: 12vh;
        border: 1px solid black;
        padding: 20px;
    }


.carousel {
    margin-top: 27vh;
    width: 400px !important;
    height: 400px !important;
}

.d-block {
    width: 400px !important;
    height: 400px !important;
    object-fit: cover;
}

h1 {
    margin-top: 40vh;
    font-family: 'Anton', sans-serif;
    color: rgb(90, 29, 0);
    text-align: center;
}
.product-filter {
    display: flex;
    align-items: center;
    margin-bottom: -60px;
}

.product-filter label,
.product-filter select {
    margin-right: 10px;
}

.product-filter button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.product-filter button:hover {
    background-color: #0056b3;
}

.product-card {
        padding: 25px; /* Adiciona uma margem inferior de 20px para separar os produtos */
    }
</style>