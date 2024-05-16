<?php
@include('../connect.php'); 

session_start(); // Inicia a sessão (se já não estiver iniciada)




// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $nome = trim($_POST['registerName']);
    $email = trim($_POST['registerEmail']);
    $senha = trim($_POST['registerPassword']);
    $cpf = trim($_POST['registerCPF']);
    $data_nascimento = trim($_POST['registerBirthdate']);
    $foto = isset($_FILES['registerPhoto']) ? $_FILES['registerPhoto']['tmp_name'] : null;

    // Validações básicas (essas validações podem ser mais robustas conforme necessário)
    if (empty($nome) || strlen($nome) < 3) {
        echo "O nome deve ter pelo menos 3 letras.";
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, insira um endereço de e-mail válido.";
        exit();
    }
    if (strlen($senha) < 6 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $senha)) {
        echo "A senha deve ter pelo menos 6 caracteres e conter pelo menos um caractere especial.";
        exit();
    }
    if (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf)) {
        echo "Por favor, insira um CPF válido.";
        exit();
    }
    $birthdate = new DateTime($data_nascimento);
    $today = new DateTime();
    $age = $today->diff($birthdate)->y;
    if ($age < 18) {
        echo "Você deve ser maior de 18 anos para se registrar.";
        exit();
    }

    // Lê o conteúdo da foto se ela foi enviada
    $fotoContent = null;
    if ($foto) {
        $fotoContent = file_get_contents($foto);
    }

    // Hash da senha
    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a declaração SQL
    $sql = "INSERT INTO usuario (nome, email, senha, cpf, data_nascimento, foto) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepara e vincula a declaração
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $null = NULL; // Necessário para o tipo de dado BLOB
        $stmt->bind_param("ssssss", $nome, $email, $hashedPassword, $cpf, $data_nascimento, $null);

        // Envia os dados BLOB
        if ($fotoContent) {
            $stmt->send_long_data(5, $fotoContent);
        } else {
            $stmt->send_long_data(5, $null);
        }

        // Executa a declaração
        if ($stmt->execute()) {
            header("Location: ../welcome.php");
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro no preparo da declaração: " . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
