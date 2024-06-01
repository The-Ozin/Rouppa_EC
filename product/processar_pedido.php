<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $cpf = $_SESSION['cpf']; // Assumindo que o CPF do usuário está na sessão
    $data_pedido = date('Y-m-d'); // Data do pedido
    $total = 0; // Inicializa o total do pedido

    // Inicia uma transação
    mysqli_begin_transaction($conn);

    try {
        // Insere o pedido na tabela `pedido`
        $query_pedido = "INSERT INTO pedido (data_pedido, fk_usuario_cpf, total, endereco_cep, endereco_rua, endereco_numero, endereco_complemento, endereco_bairro, endereco_cidade, endereco_estado)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_pedido = mysqli_prepare($conn, $query_pedido);
        mysqli_stmt_bind_param($stmt_pedido, 'ssdsssssss', $data_pedido, $cpf, $total, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado);
        mysqli_stmt_execute($stmt_pedido);

        // Obtém o ID do pedido recém-criado
        $pedido_id = mysqli_insert_id($conn);

        // Loop pelos itens do carrinho e insere na tabela `itens_pedido`
        foreach ($_SESSION['cart'] as $prod_id => $quantidade) {
            // Consulta SQL para obter as informações do produto
            $query_produto = "SELECT preco FROM produto WHERE prod_id = ?";
            $stmt_produto = mysqli_prepare($conn, $query_produto);
            mysqli_stmt_bind_param($stmt_produto, 'i', $prod_id);
            mysqli_stmt_execute($stmt_produto);
            $result_produto = mysqli_stmt_get_result($stmt_produto);

            // Verifica se a consulta foi bem-sucedida e se há resultados
            if ($result_produto && mysqli_num_rows($result_produto) > 0) {
                $row_produto = mysqli_fetch_assoc($result_produto);
                $preco = $row_produto['preco'];
                $subtotal = $preco * $quantidade; // Calcula o subtotal do item
                $total += $subtotal; // Adiciona o subtotal ao total do pedido

                // Insere o item na tabela `itens_pedido`
                $query_item = "INSERT INTO itens_pedido (fk_pedido_id, fk_produto_prod_id, quantidade, preco_unitario)
                               VALUES (?, ?, ?, ?)";
                $stmt_item = mysqli_prepare($conn, $query_item);
                mysqli_stmt_bind_param($stmt_item, 'iiid', $pedido_id, $prod_id, $quantidade, $preco);
                mysqli_stmt_execute($stmt_item);
            }
        }

        // Atualiza o total do pedido na tabela `pedido`
        $query_update_total = "UPDATE pedido SET total = ? WHERE id = ?";
        $stmt_update_total = mysqli_prepare($conn, $query_update_total);
        mysqli_stmt_bind_param($stmt_update_total, 'di', $total, $pedido_id);
        mysqli_stmt_execute($stmt_update_total);

        // Se tudo for bem-sucedido, confirma a transação
        mysqli_commit($conn);

        // Limpa o carrinho
        unset($_SESSION['cart']);

        // Redireciona para uma página de sucesso ou de resumo do pedido
        header("Location: resumo_pedido.php?pedido_id=$pedido_id");
        exit();
    } catch (Exception $e) {
        // Se houver um erro, reverte a transação
        mysqli_rollback($conn);
        echo "Erro ao processar o pedido: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
?>
