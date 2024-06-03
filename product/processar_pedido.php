<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $cpf = $_SESSION['cpf']; 
    $data_pedido = date('Y-m-d'); 
    $total = 0; 


    mysqli_begin_transaction($conn);

    try {
        $query_pedido = "INSERT INTO pedido (data_pedido, fk_usuario_cpf, total, endereco_cep, endereco_rua, endereco_numero, endereco_complemento, endereco_bairro, endereco_cidade, endereco_estado)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_pedido = mysqli_prepare($conn, $query_pedido);
        mysqli_stmt_bind_param($stmt_pedido, 'ssdsssssss', $data_pedido, $cpf, $total, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado);
        mysqli_stmt_execute($stmt_pedido);


        $pedido_id = mysqli_insert_id($conn);

        foreach ($_SESSION['cart'] as $prod_id => $quantidade) {

            $query_produto = "SELECT preco FROM produto WHERE prod_id = ?";
            $stmt_produto = mysqli_prepare($conn, $query_produto);
            mysqli_stmt_bind_param($stmt_produto, 'i', $prod_id);
            mysqli_stmt_execute($stmt_produto);
            $result_produto = mysqli_stmt_get_result($stmt_produto);

           
            if ($result_produto && mysqli_num_rows($result_produto) > 0) {
                $row_produto = mysqli_fetch_assoc($result_produto);
                $preco = $row_produto['preco'];
                $subtotal = $preco * $quantidade; 
                $total += $subtotal;

                $query_item = "INSERT INTO itens_pedido (fk_pedido_id, fk_produto_prod_id, quantidade, preco_unitario)
                               VALUES (?, ?, ?, ?)";
                $stmt_item = mysqli_prepare($conn, $query_item);
                mysqli_stmt_bind_param($stmt_item, 'iiid', $pedido_id, $prod_id, $quantidade, $preco);
                mysqli_stmt_execute($stmt_item);
            }
        }

        $query_update_total = "UPDATE pedido SET total = ? WHERE id = ?";
        $stmt_update_total = mysqli_prepare($conn, $query_update_total);
        mysqli_stmt_bind_param($stmt_update_total, 'di', $total, $pedido_id);
        mysqli_stmt_execute($stmt_update_total);


        mysqli_commit($conn);


        unset($_SESSION['cart']);


        header("Location: resumo_pedido.php?pedido_id=$pedido_id");
        exit();
    } catch (Exception $e) {
        
        mysqli_rollback($conn);
        echo "Erro ao processar o pedido: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}

