<?php
@include('../connect.php'); // Include the database connection script

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['registerName']);
    $email = trim($_POST['registerEmail']);
    $senha = trim($_POST['registerPassword']);
    $cpf = trim($_POST['registerCPF']);
    $data_nascimento = trim($_POST['registerBirthdate']);
    $foto = isset($_FILES['registerPhoto']) ? $_FILES['registerPhoto']['tmp_name'] : null;
    
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

    $fotoContent = null;
    if ($foto) {
        $fotoContent = file_get_contents($foto);
    }

    $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome, email, senha, cpf, data_nascimento, foto) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql); // Use $pdo instead of $conn
    if ($stmt) {
        $null = NULL;
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $hashedPassword);
        $stmt->bindParam(4, $cpf);
        $stmt->bindParam(5, $data_nascimento);
        $stmt->bindParam(6, $null, PDO::PARAM_LOB);

        if ($fotoContent) {
            $stmt->bindValue(6, $fotoContent, PDO::PARAM_LOB);
        }

        if ($stmt->execute()) {
            header("Location: ../user/user_login.php");
        } else {
            echo "Erro ao cadastrar: " . $stmt->errorInfo()[2];
        }

        $stmt->closeCursor();
    } else {
        echo "Erro no preparo da declaração: " . $pdo->errorInfo()[2];
    }
} else {
    echo "Método de requisição inválido.";
}
?>
