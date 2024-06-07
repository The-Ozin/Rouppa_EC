<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name'])) {
    header("Location: http://localhost/Rouppa_EC/welcome.php");
    exit();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

@include('../layouts/navbar.php');

// Processar a atualização da quantidade
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['prod_id']) && isset($_POST['quantity'])) {
        $prod_id = $_POST['prod_id'];
        $quantity = $_POST['quantity'];

        // Verificar se o produto está no carrinho
        if (isset($_SESSION['cart'][$prod_id])) {
            // Atualizar a quantidade do produto no carrinho
            $_SESSION['cart'][$prod_id] = $quantity;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu carrinho</title>
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
    <div class="container" style="display: flex; flex-direction: column; align-items: center;">
        <h1 class="centralize">Seu Carrinho</h1>
        <?php
            foreach ($_SESSION['cart'] as $prod_id => $quantidade) {

                $query = "SELECT produto.*, produto_fotos.foto
                        FROM produto
                        LEFT JOIN produto_fotos ON produto.prod_id = produto_fotos.prod_id
                        WHERE produto.prod_id = $prod_id"; 

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if (!empty($row['foto'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" alt="' . htmlspecialchars($row['nome']) . '" style="max-width: 100px;">';
                    } else {

                        echo '<img src="caminho/para/imagem/padrao.jpg" alt="Imagem padrão" style="max-width: 100px;">';
                    }
                    echo '<div class="product-card">';
                    echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                    echo '<p>Preço Unitário: R$ ' . htmlspecialchars($row['preco']) . '</p>';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="prod_id" value="' . $prod_id . '">';
                    echo '<label for="quantity">Quantidade: </label>';
                    echo '<select name="quantity" id="quantity" onchange="this.form.submit()">';
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<option value="' . $i . '"';
                        if ($i == $quantidade) {
                            echo ' selected';
                        }
                        echo '>' . $i . '</option>';
                    }
                    echo '</select>';
                    echo '</form>';
                    echo '<form action="cart_remove.php" method="post">';
                    echo '<input type="hidden" name="prod_id" value="' . $prod_id . '">';
                    echo '<button type="submit" class="remove-button">Remover do Carrinho</button>';
                    echo '</form>';
                    echo '</div>';
                    
                }
            }
        ?>
        <div class="total">
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $prod_id => $quantidade) {

                $query = "SELECT preco FROM produto WHERE prod_id = $prod_id";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $subtotal = $row['preco'] * $quantidade;
                    $total += $subtotal;
                }
            }

            echo 'Valor Total: R$ ' . number_format($total, 2, ',', '.');
            ?>
        </div>
        <div class="checkout-button">
            <a href="finalizar_compra.php" class="checkout-link">Finalizar Compra</a>
        </div>
    </div>
    <footer style="margin-top: 30vh; text-align: center;"></footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>
</body>
</html>

<style>

@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');    

/* Estilo para a página do carrinho */
.cart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 5vh; /* Reduzindo a margem superior */
}

.cart-item {
    display: flex;
    flex-direction: column; /* Alterando para uma disposição em coluna */
    align-items: center; /* Centralizando os itens */
    width: 80%; /* Ajustando a largura */
    max-width: 600px; /* Largura máxima */
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px; /* Aumentando o espaçamento inferior */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cart-item img {
    width: 100px; /* Ajustando a largura da imagem */
    height: auto;
    margin-bottom: 20px; /* Aumentando o espaçamento abaixo da imagem */
}

.cart-item-info {
    width: 100%; /* Definindo a largura total */
}

.cart-item h3,
.cart-item p {
    margin: 10px 0; /* Aumentando o espaçamento vertical */
    text-align: center; /* Centralizando o texto */
}

.cart-item-price {
    font-weight: bold; /* Deixando o preço em negrito */
}

.cart-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px; /* Aumentando a margem superior */
    width: 100%; /* Largura total */
}

.cart-buttons button {
    padding: 10px 20px; /* Ajustando o espaçamento interno */
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s; /* Transição suave */
}

.cart-buttons button.remove-button {
    background-color: #dc3545; /* Cor vermelha */
    border: 1px solid #dc3545; /* Borda vermelha */
}

.cart-buttons button.remove-button:hover {
    background-color: #c82333; /* Cor vermelha escura ao passar o mouse */
    border: 1px solid #c82333; /* Borda vermelha escura ao passar o mouse */
}

.total {
    background-color: #007bff;
    color: #fff;
    border-radius: 10px;
    padding: 20px; /* Ajustando o espaçamento interno */
    margin: 40px auto; /* Aumentando o espaçamento externo */
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 400px;
}

.checkout-button {
    text-align: center;
    margin-top: 20px;
}

.checkout-link {
    padding: 12px 24px; /* Aumentando o espaçamento interno */
    background-color: #28a745; /* Cor verde */
    color: #fff; /* Cor do texto branco */
    border: none;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s; /* Transição suave */
}

.checkout-link:hover {
    background-color: #218838; /* Cor verde escura ao passar o mouse */
}

/* Adicionando ícones aos botões */
.cart-buttons button:before {
    content: "\f07a"; /* Ícone do carrinho de lixo do FontAwesome */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    margin-right: 5px;
}

/* Feedback visual ao clicar nos botões */
.cart-buttons button:active {
    opacity: 0.7; /* Escurecendo o botão ao ser clicado */
}

/* Ajustes para dispositivos móveis */
@media screen and (max-width: 600px) {
    .cart-item {
        width: 95%; /* Ajustando a largura */
    }
}


/* Estilo para o footer */

footer {
    margin-top: 50vh; /* Ajustando margem superior */
    text-align: center; /* Centralizando texto */
}

</style>
