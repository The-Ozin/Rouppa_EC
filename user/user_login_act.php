<?php
include('../connect.php');
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Define as variáveis de sessão após o login bem-sucedido
        $_SESSION['user_name'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['foto'] = $usuario['foto']; // Armazena o caminho relativo da foto do usuário
    
        // Redireciona para a página de boas-vindas
        header("Location: ../welcome.php");
        exit();
    } else {
        echo json_encode(["success" => false, "error" => "Credenciais inválidas. Tente novamente."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro: " . $e->getMessage()]);
}
?>


<script>
    // Função para exibir alerta em JavaScript
    function showAlert(message) {
        alert(message);
    }

    // Obter o formulário de login
    var loginForm = document.getElementById("loginForm");

    // Adicionar um ouvinte de evento para o envio do formulário
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Impedir o envio padrão do formulário

        // Obter os dados do formulário
        var formData = new FormData(loginForm);

        // Enviar a solicitação assíncrona para o servidor
        fetch("user_login_act.php", {
            method: "POST",
            body: formData
        })
        .then(function(response) {
            return response.json(); // Converter a resposta em JSON
        })
        .then(function(data) {
            // Lidar com a resposta do servidor
            if (!data.success) {
                // Exibir alerta se o login falhou
                showAlert(data.error);
            }
        })
        .catch(function(error) {
            console.error("Erro ao processar a solicitação:", error);
        });
    });
</script>
