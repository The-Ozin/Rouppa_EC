<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['nome']) && isset($_POST['categoria']) && isset($_POST['tamanho']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['condicao_uso']) && isset($_POST['estado_peca']) && isset($_POST['fk_loja_cnpj']) && isset($_FILES['fotos'])) {

        // Conexão com o banco de dados (substitua pelas suas credenciais)
        $servername = "localhost";
        $username = "root";
        $password = "wordpass";
        $dbname = "rouppa";

        // Crie uma conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }   

        // Prepara os dados para inserção no banco de dados
        $nome = $conn->real_escape_string($_POST['nome']);
        $categoria = $conn->real_escape_string($_POST['categoria']);
        $tamanho = $conn->real_escape_string($_POST['tamanho']);
        $descricao = $conn->real_escape_string($_POST['descricao']);
        $preco = $conn->real_escape_string($_POST['preco']);
        $condicao_uso = (int) $_POST['condicao_uso'];
        $estado_peca = $conn->real_escape_string($_POST['estado_peca']);
        $fk_loja_cnpj = $conn->real_escape_string($_POST['fk_loja_cnpj']);

        // Query SQL para inserir os dados na tabela de produtos
        $sql = "INSERT INTO produto (nome, categoria, tamanho, descricao, preco, condicao_uso, estado_peca, fk_loja_cnpj) VALUES ('$nome', '$categoria', '$tamanho', '$descricao', '$preco', '$condicao_uso', '$estado_peca', '$fk_loja_cnpj')";

        if ($conn->query($sql) === TRUE) {
            $produto_id = $conn->insert_id;
            
            foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
                $foto = addslashes(file_get_contents($tmp_name));
                $sql_foto = "INSERT INTO produto_fotos (produto_id, foto) VALUES ('$produto_id', '$foto')";
                
                if (!$conn->query($sql_foto) === TRUE) {
                    echo "Erro ao cadastrar a foto: " . $conn->error;
                }
            }
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }

        // Fecha a conexão
        $conn->close();
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>
