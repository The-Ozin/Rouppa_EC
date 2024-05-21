<?php
include('../connect.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Define a variável de sessão com o nome do usuário
        $_SESSION['nome'] = $usuario['nome'];

        // Redireciona para a página de boas-vindas se o login for bem-sucedido
        header("Location: ../welcome.php");
        exit(); // Certifique-se de sair após o redirecionamento para evitar que o código adicional seja executado
    } else {
        // Se as credenciais estiverem incorretas, retornar JSON com mensagem de erro
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
