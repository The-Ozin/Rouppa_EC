<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = $_POST['type'];

    if ($type == 1) {

        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        $foto = $_POST['foto'];

        if (empty($cpf) || empty($nome) || empty($email) || empty($data_nascimento)) {
            echo "Todos os campos são obrigatórios.";
            exit;
        }


        $query = "UPDATE usuario SET nome = ?, email = ?, data_nascimento = ?, foto = ? WHERE cpf = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $data_nascimento, $foto, $cpf);
            mysqli_stmt_execute($stmt);


            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Usuário atualizado com sucesso.";
            } else {
                echo "Nenhuma alteração foi feita.";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }

    } elseif ($type == 2) {

        $cnpj = $_POST['cnpj'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];

        if (empty($cnpj) || empty($nome) || empty($endereco)) {
            echo "Todos os campos são obrigatórios.";
            exit;
        }


        $query = "UPDATE loja SET nome = ?, endereco = ? WHERE cnpj = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "sss", $nome, $endereco, $cnpj);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Loja atualizada com sucesso.";
            } else {
                echo "Nenhuma alteração foi feita.";
            }


            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }
    } else {
        echo "Tipo de atualização inválido.";
    }


    mysqli_close($conn);

    header('Location: adm.php');
    exit;
} else {
    echo "Método de requisição inválido.";
}
?>
