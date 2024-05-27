<?php
include('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter o tipo de atualização (1 para usuário, 2 para loja)
    $type = $_POST['type'];

    if ($type == 1) {
        // Atualizar usuário
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        $foto = $_POST['foto'];

        // Validação básica (você pode adicionar mais validações conforme necessário)
        if (empty($cpf) || empty($nome) || empty($email) || empty($data_nascimento)) {
            echo "Todos os campos são obrigatórios.";
            exit;
        }

        // Preparar a consulta SQL
        $query = "UPDATE usuario SET nome = ?, email = ?, data_nascimento = ?, foto = ? WHERE cpf = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $data_nascimento, $foto, $cpf);
            mysqli_stmt_execute($stmt);

            // Verificar se a atualização foi bem-sucedida
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Usuário atualizado com sucesso.";
            } else {
                echo "Nenhuma alteração foi feita.";
            }

            // Fechar a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }

    } elseif ($type == 2) {
        // Atualizar loja
        $cnpj = $_POST['cnpj'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];

        // Validação básica (você pode adicionar mais validações conforme necessário)
        if (empty($cnpj) || empty($nome) || empty($endereco)) {
            echo "Todos os campos são obrigatórios.";
            exit;
        }

        // Preparar a consulta SQL
        $query = "UPDATE loja SET nome = ?, endereco = ? WHERE cnpj = ?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, "sss", $nome, $endereco, $cnpj);
            mysqli_stmt_execute($stmt);

            // Verificar se a atualização foi bem-sucedida
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Loja atualizada com sucesso.";
            } else {
                echo "Nenhuma alteração foi feita.";
            }

            // Fechar a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conn);
        }
    } else {
        echo "Tipo de atualização inválido.";
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);

    // Redirecionar de volta para a página de administração
    header('Location: adm.php'); // Substitua 'admin_page.php' pelo nome da sua página de administração
    exit;
} else {
    echo "Método de requisição inválido.";
}
?>
