<?php
session_start();
include('../connect.php');

if (!isset($_GET['pedido_id'])) {
    echo "Pedido não encontrado.";
    exit();
}

if (!isset($_SESSION['user_name'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}

$pedido_id = $_GET['pedido_id'];

// Consulta para obter os detalhes do pedido
$query_pedido = "SELECT data_pedido, fk_usuario_cpf, total,
                        endereco_cep, endereco_rua, endereco_numero,
                        endereco_complemento, endereco_bairro,
                        endereco_cidade, endereco_estado
                 FROM pedido
                 WHERE id = ?";
$stmt_pedido = $conn->prepare($query_pedido);
if (!$stmt_pedido) {
    echo "Erro na preparação da consulta para obter os detalhes do pedido: " . $conn->error;
    exit();
}
$stmt_pedido->bind_param("i", $pedido_id);
$stmt_pedido->execute();
$result_pedido = $stmt_pedido->get_result();

if ($result_pedido->num_rows == 0) {
    echo "Pedido não encontrado.";
    exit();
}

$pedido = $result_pedido->fetch_assoc();
$cpf_usuario = $pedido['fk_usuario_cpf'];

// Consulta para obter os dados do usuário
$query_usuario = "SELECT nome, email FROM usuario WHERE cpf = ?";
$stmt_usuario = $conn->prepare($query_usuario);
if (!$stmt_usuario) {
    echo "Erro na preparação da consulta para obter os dados do usuário: " . $conn->error;
    exit();
}
$stmt_usuario->bind_param("s", $cpf_usuario);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario = $result_usuario->fetch_assoc();

// Consulta para obter os itens do pedido
$query_itens = "SELECT p.nome, p.preco, i.quantidade FROM itens_pedido i
                JOIN produto p ON i.fk_produto_prod_id = p.prod_id
                WHERE i.fk_pedido_id = ?";
$stmt_itens = $conn->prepare($query_itens);
if (!$stmt_itens) {
    echo "Erro na preparação da consulta para obter os itens do pedido: " . $conn->error;
    exit();
}
$stmt_itens->bind_param("i", $pedido_id);
$stmt_itens->execute();
$result_itens = $stmt_itens->get_result();

$total = $pedido['total'];
@include('../layouts/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumo do Pedido</title>
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
    <div class="container">
        <div class="order-summary">
            <h2>Pedido Finalizado</h2>
            <p>Pedido nº: <?php echo $pedido_id; ?></p>
            <p>Data: <?php echo $pedido['data_pedido']; ?></p>
            <h3>Dados do Cliente</h3>
            <p>Nome: <?php echo $usuario['nome']; ?></p>
            <p>Email: <?php echo $usuario['email']; ?></p>
            <h3>Endereço de Entrega</h3>
            <p>Rua: <?php echo $pedido['endereco_rua']; ?>, Nº: <?php echo $pedido['endereco_numero']; ?></p>
            <p>Complemento: <?php echo $pedido['endereco_complemento']; ?></p>
            <p>Bairro: <?php echo $pedido['endereco_bairro']; ?></p>
            <p>Cidade: <?php echo $pedido['endereco_cidade']; ?> - <?php echo $pedido['endereco_estado']; ?></p>
            <p>CEP: <?php echo $pedido['endereco_cep']; ?></p>
            <h3>Itens do Pedido</h3>
            <ul>
                <?php while ($item = $result_itens->fetch_assoc()) {
                    $subtotal = $item['preco'] * $item['quantidade'];
                    echo "<li>{$item['nome']} - Quantidade: {$item['quantidade']} - Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "</li>";
                } ?>
            </ul>
            <p>Total do Pedido: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
        </div>
    </div>

</body>

<footer>
    <?php 
        @include('../layouts/footer.php');
    ?>
    </footer>
</html>
<style>
    .main-content {
        min-height: calc(100vh - 100px); /* Assuming your footer height is 100px */
    }

    .container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

    .order-summary {
        padding: 20px;
        border-radius: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        background-color: whitesmoke;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }

    h2 {
        margin-top: 0;
    }



</style>