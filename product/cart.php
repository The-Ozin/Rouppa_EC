<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name']) && !isset($_SESSION['nome_loja'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display&family=Source+Serif+4&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</head>
<body>
    <h1 class="centralize">Seu Carrinho</h1>
    <div class="container">
        <?php
            foreach ($_SESSION['cart'] as $prod_id => $quantidade) {
                // Consulta SQL para obter os detalhes do produto e suas fotos
                $query = "SELECT produto.*, produto_fotos.foto
                        FROM produto
                        LEFT JOIN produto_fotos ON produto.prod_id = produto_fotos.prod_id
                        WHERE produto.prod_id = $prod_id"; // Filtrar pelo ID do produto no carrinho

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    // Exibir a imagem do produto
                    if (!empty($row['foto'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" alt="' . htmlspecialchars($row['nome']) . '" style="max-width: 100px;">';
                    } else {
                        // Se não houver imagem disponível, exiba uma imagem padrão
                        echo '<img src="caminho/para/imagem/padrao.jpg" alt="Imagem padrão" style="max-width: 100px;">';
                    }

                    // Exibir os detalhes do produto
                    echo '<div class="product-card">';
                    echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                    echo '<p>Preço: R$ ' . htmlspecialchars($row['preco']) . '</p>';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="prod_id" value="' . $prod_id . '">';
                    echo '<label for="quantity">Quantidade:</label>';
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
    </div>
    <div class="total">
    <?php
    // Variável para armazenar o valor total
    $total = 0;

    // Loop pelos produtos no carrinho
    foreach ($_SESSION['cart'] as $prod_id => $quantidade) {
        // Consulta SQL para obter o preço do produto
        $query = "SELECT preco FROM produto WHERE prod_id = $prod_id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Calcula o subtotal do produto (preço * quantidade)
            $subtotal = $row['preco'] * $quantidade;
            // Adiciona o subtotal ao total
            $total += $subtotal;
        }
    }

    // Exibe o valor total formatado
    echo 'Valor Total: R$ ' . number_format($total, 2, ',', '.');
    ?>
</div>
<div class="checkout-button">
    <a href="finalizar_compra.php" class="checkout-link">Finalizar Compra</a>
</div>

    <footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>
</body>
</html>

<style>
    .checkout-button {
    text-align: center;
    margin-top: 20px;
    padding-bottom: 20px;
}

.checkout-link {
    padding: 10px 20px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    
}

.checkout-link:hover {
    background-color: #218838;
}

h1.centralize {
    font-size: 32px; /* Tamanho da fonte */
    color: #333; /* Cor do texto */
    font-family: 'Roboto', sans-serif; /* Fonte */
    text-align: center; /* Alinhamento central */
    margin-top: 20px; /* Espaçamento superior */
    margin-bottom: 20px; /* Espaçamento inferior */
}

.product-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    max-width: 400px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.product-card img {
    max-width: 100px;
    margin-bottom: 10px;
}

.product-card h3,
.product-card p {
    margin: 5px 0;
    text-align: center;
}

.product-card button {
    padding: 8px 16px;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.product-card button:hover {
    background-color: darkred;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.quantity-update {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.quantity-update input[type="number"] {
    width: 50px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin: 0 10px;
}

.quantity-update button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.quantity-update button:hover {
    background-color: #0056b3;
}

.total {
    background-color: #007bff; /* Cor de fundo azul */
    color: #fff; /* Cor do texto branco */
    border-radius: 10px; /* Bordas arredondadas */
    padding: 10px; /* Espaçamento interno */
    margin: 20px auto; /* Centralizar horizontalmente */
    text-align: center; /* Texto centralizado */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
    width: 80%; /* Largura da div */
    max-width: 400px; /* Largura máxima */
}

.update-button {
    padding: 8px 16px;
    background-color: #28a745; /* Cor de fundo verde */
    color: #fff; /* Cor do texto branco */
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.update-button:hover {
    background-color: #218838; /* Cor de fundo verde escuro ao passar o mouse */
}

.remove-button {
    padding: 8px 16px;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.remove-button:hover {
    background-color: darkred;
}
</style>
