<?php
include('../connect.php'); 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $tamanho = trim($_POST['tamanho']);
    $descricao = trim($_POST['descricao']);
    $preco = trim($_POST['preco']);
    $foto = isset($_FILES['foto']) ? $_FILES['foto']['tmp_name'] : null;
    $condicao_uso = isset($_POST['condicao_uso']) ? 1 : 0;
    $estado_peca = trim($_POST['estado_peca']);
    $fk_loja_cnpj = trim($_POST['fk_loja_cnpj']);
    $fk_usuario_cpf = $_SESSION['cpf']; // Assuming you have stored user's CPF in session
    $fk_adm_id = null; // Assuming this is not needed for product creation

    // Verifique se todos os campos são preenchidos corretamente
    if (empty($nome) || empty($tamanho) || empty($descricao) || empty($preco) || empty($estado_peca) || empty($fk_loja_cnpj)) {
        echo "Por favor, preencha todos os campos.";
        exit();
    }

    // Verifique se a foto foi carregada corretamente
    if (!$foto) {
        echo "Por favor, faça o upload de uma foto.";
        exit();
    }

    // Verifique se o arquivo de foto é uma imagem válida
    $check = getimagesize($foto);
    if ($check === false) {
        echo "O arquivo enviado não é uma imagem válida.";
        exit();
    }

    // Prepara a consulta SQL para inserir os dados do produto
    $sql = "INSERT INTO produto (tamanho, descricao_, preco, nome, condicao_uso, estado_peca, fk_loja_cnpj, fk_usuario_cpf, fk_adm_id, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Abre o arquivo de foto e lê seu conteúdo
        $fotoContent = file_get_contents($foto);

        // Vincula os parâmetros da query preparada
        $stmt->bind_param("ssdssssibs", $tamanho, $descricao, $preco, $nome, $condicao_uso, $estado_peca, $fk_loja_cnpj, $fk_usuario_cpf, $fk_adm_id, $fotoContent);

        // Executa a query preparada
        if ($stmt->execute()) {
            header("Location: ../user/user_login.php");
            exit();
        } else {
            echo "Erro ao cadastrar o produto: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro no preparo da declaração: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
