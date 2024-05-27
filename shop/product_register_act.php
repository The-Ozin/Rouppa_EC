<?php
session_start();


$isLoja = isset($_SESSION['cnpj']);
$isUsuario = isset($_SESSION['cpf']);

include('../connect.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos do formulário foram enviados
    if (isset($_POST['nome'], $_POST['productCategory'], $_POST['tamanho'], $_POST['descricao'], $_POST['preco'], $_POST['condicao_uso'], $_FILES['fotos'])) {

        // Escapa e obtém os valores dos campos do formulário
        $nome = $conn->real_escape_string($_POST['nome']);
        $categoria = $conn->real_escape_string($_POST['productCategory']);
        $tamanho = $conn->real_escape_string($_POST['tamanho']);
        $descricao = $conn->real_escape_string($_POST['descricao']);
        $preco = $conn->real_escape_string($_POST['preco']);
        $condicao_uso = (int)$_POST['condicao_uso'];
        $fk_loja_cnpj = $isLoja ? "'" . $conn->real_escape_string($_SESSION['cnpj']) . "'" : "NULL";
        $fk_usuario_cpf = $isUsuario ? "'" . $conn->real_escape_string($_SESSION['cpf']) . "'" : "NULL";

        // Obtem a primeira foto (supondo que você quer armazenar uma única foto na tabela produto)
        $foto = addslashes(file_get_contents($_FILES['fotos']['tmp_name'][0]));

        // Query SQL para inserir o produto no banco de dados
        $sql = "INSERT INTO produto (nome, categoria, tamanho, descricao_, preco, condicao_uso, foto, fk_loja_cnpj, fk_usuario_cpf) 
                VALUES ('$nome', '$categoria', '$tamanho', '$descricao', '$preco', '$condicao_uso', '$foto', $fk_loja_cnpj, $fk_usuario_cpf)";

        // Executa a consulta SQL
        if ($conn->query($sql) === TRUE) {
            // Redireciona o usuário para a página de boas-vindas
            header("Location: http://localhost/Rouppa/welcome.php");
            exit(); // Certifica-se de que o script seja encerrado após o redirecionamento
        } else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>
