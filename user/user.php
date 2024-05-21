<?php
@include('../connect.php'); 

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

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $null = NULL;
        $stmt->bind_param("ssssss", $nome, $email, $hashedPassword, $cpf, $data_nascimento, $null);

        if ($fotoContent) {
            $stmt->send_long_data(5, $fotoContent);
        } else {
            $stmt->send_long_data(5, $null);
        }

        if ($stmt->execute()) {
            header("Location: ../user/user_login.php");
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro no preparo da declaração: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>
