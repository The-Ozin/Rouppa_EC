@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Cadastro</title>
</head>

<style>
    .container-form {
        margin-top: 300px;
        width: 800px !important;
        background-color: wheat;
        border: 1px solid rgba(90, 29, 0);
        border-radius: 5vh;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .Rouppa {
        margin-top: 80px;
        font-size: 80px;
        font-family: 'Noto Serif Display', serif;
        text-align: center;
        font-weight: bold;
        font-style: italic;
        color: rgb(215,90, 90);
    }

    footer {
        position: relative;
        margin-top: 20px !important;
        bottom: 0;
        width: 100%;
    }

</style>

<body>
<main>
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="Rouppa">Rouppa</h1>
                <!-- Pills navs -->
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-mdb-pill-init href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-mdb-pill-init href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form id="loginForm">
                            <div class="text-center mb-3">
                                <p>Sign in with:</p>
                                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>

                                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>

                                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>

                                <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>

                            <p class="text-center">or:</p>

                            <!-- Email input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="loginName" class="form-control" style="width: 100%;" required/>
                                <label class="form-label" for="loginName">Email or username</label>
                            </div>

                            <!-- Password input -->
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="loginPassword" class="form-control" style="width: 100%;" required/>
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>

                            <!-- 2 column grid layout -->
                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked>
                                        <label class="form-check-label" for="loginCheck"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Simple link -->
                                    <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: rgb(215,90, 90);">Sign in</button>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Not a member? <a href="#!">Register</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <form id="registerForm">
                    <div class="text-center mb-3">
                        <p>Sign up with:</p>
                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button>

                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                            <i class="fab fa-google"></i>
                        </button>

                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                        </button>

                        <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>

                    <p class="text-center">or:</p>

                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="registerName" class="form-control" style="width: 100%;" required />
                        <label class="form-label" for="registerName">Name</label>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="registerEmail" class="form-control" style="width: 100%;" required />
                        <label class="form-label" for="registerEmail">Email</label>
                    </div>

                    <!-- CPF input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="registerCPF" class="form-control" style="width: 100%;" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required />
                        <label class="form-label" for="registerCPF">CPF</label>
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="registerPassword" class="form-control" style="width: 100%;" required />
                        <label class="form-label" for="registerPassword">Password</label>
                    </div>

                    <!-- Repeat Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="registerRepeatPassword" class="form-control" style="width: 100%;" required />
                        <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                    </div>

                    <!-- Birthdate input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="date" id="registerBirthdate" class="form-control" style="width: 100%;" required />
                        <label class="form-label" for="registerBirthdate">Birthdate</label>
                    </div>

                    <!-- Photo input -->
                    <div class="mb-4">
                        <label for="registerPhoto" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="registerPhoto" style="width: 100%;">
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText" required />
                        <label class="form-check-label" for="registerCheck">I have read and agree to the terms</label>
                    </div>

                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
</main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.querySelector('#loginForm');
        const registerForm = document.querySelector('#registerForm');

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            if (validateLoginForm()) {
                sendLoginData();
            } else {
                showAlert('Por favor, preencha todos os campos corretamente no formulário de login.');
            }
        });

        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            if (validateRegisterForm()) {
                // Aqui você envia o formulário via AJAX ou fetch
                // Por simplicidade, vou supor que você está usando fetch
                fetch('caminho/do/seu/script.php', {
                    method: 'POST',
                    body: new FormData(registerForm)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ocorreu um erro ao processar a solicitação.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Exibe o SweetAlert com base na resposta do servidor
                    Swal.fire({
                        icon: 'info',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                })
                .catch(error => {
                    console.error('Erro:', error);
                    // Exibe uma mensagem de erro genérica
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Ocorreu um erro ao processar a solicitação.',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });
    });

    function validateLoginForm() {
        // Restante do código de validação do formulário de login...
    }

    function validateRegisterForm() {
    const nameField = document.querySelector('#registerName');
    const emailField = document.querySelector('#registerEmail');
    const passwordField = document.querySelector('#registerPassword');
    const repeatPasswordField = document.querySelector('#registerRepeatPassword');
    const birthdateField = document.querySelector('#registerBirthdate');
    const cpfField = document.querySelector('#registerCPF'); // Novo campo de CPF
    const photoInput = document.querySelector('#registerPhoto');
    const photoFile = photoInput.files[0]; // Obtém o arquivo selecionado

    const name = nameField.value.trim();
    const email = emailField.value.trim();
    const password = passwordField.value.trim();
    const repeatPassword = repeatPasswordField.value.trim();
    const birthdate = new Date(birthdateField.value);
    const eighteenYearsAgo = new Date();
    eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);
    const cpf = cpfField.value.trim(); // Valor do CPF

    // Validação de data de nascimento
    if (birthdate >= new Date() || birthdate > eighteenYearsAgo) {
        showAlert('Você deve ser maior de 18 anos para se registrar.');
        return false;
    }

    // Validação de nome
    if (!name || name.length < 3) {
        showAlert('O nome deve ter pelo menos 3 letras.');
        return false;
    }

    // Validação de e-mail simples
    if (!email || !isValidEmail(email)) {
        showAlert('Por favor, insira um endereço de e-mail válido.');
        return false;
    }

    // Validação de senha
    if (!password || password.length < 6) {
        showAlert('A senha deve ter pelo menos 6 caracteres.');
        return false;
    }

    // Validação de senha repetida
    if (password !== repeatPassword) {
        showAlert('As senhas não coincidem.');
        return false;
    }

    // Validação de CPF com expressão regular
    const cpfRegex = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
    if (!cpfRegex.test(cpf)) {
        showAlert('Por favor, insira um CPF válido.');
        return false;
    }

    if (photoFile) {
        // O usuário selecionou uma foto
        console.log('Foto selecionada:', photoFile.name);

        // Verifica o tipo do arquivo
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(photoFile.type)) {
            showAlert('O tipo de arquivo da foto não é suportado. Por favor, selecione uma imagem JPEG, PNG ou GIF.');
            return false; // Retorna falso para impedir o envio do formulário
        }

        // Verifica o tamanho do arquivo (limite de 5 MB neste exemplo)
        const maxSize = 5 * 1024 * 1024; // 5 MB em bytes
        if (photoFile.size > maxSize) {
            showAlert('O tamanho da foto excede o limite máximo de 5 MB. Por favor, selecione uma imagem menor.');
            return false; // Retorna falso para impedir o envio do formulário
        }

        // Aqui você pode adicionar qualquer outra lógica de manipulação de arquivo, se necessário

    } else {
        // Nenhuma foto foi selecionada
        console.log('Nenhuma foto selecionada.');
    }

    return true;
}


    function isValidEmail(email) {
        // Expressão regular simples para validação de e-mail
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showAlert(message) {
        // Exibir alerta personalizado com SweetAlert
        Swal.fire({
            title: 'Erro!',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }

    function sendLoginData() {
        // Simulação de envio de dados de login para o backend
        // Aqui você pode adicionar sua lógica para enviar os dados para o backend via AJAX ou fetch
        // Este é apenas um exemplo simulado
        showAlert('Dados de login enviados com sucesso.');
    }

    function sendRegisterData() {
        // Simulação de envio de dados de registro para o backend
        // Aqui você pode adicionar sua lógica para enviar os dados para o backend via AJAX ou fetch
        // Este é apenas um exemplo simulado
        Swal.fire({
            title: 'Sucesso!',
            text: 'Cadastro realizado com sucesso',
            icon: 'success'
        });
    }
</script>
</body>
</html>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $name = $_POST["registerName"];
    $email = $_POST["registerEmail"];
    $cpf = $_POST["registerCPF"];
    $birthdate = $_POST["registerBirthdate"];
    $password = $_POST["registerPassword"];

    // Outras validações, se necessário

    // Verifica se o email ou CPF já existem no banco de dados
    $checkQuery = "SELECT * FROM usuario WHERE email = '$email' OR cpf = '$cpf'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Já existe um usuário com este email ou CPF
        $response = "Já existe um usuário cadastrado com este email ou CPF.";
    } else {
        // Insere os dados no banco de dados
        $insertQuery = "INSERT INTO usuario (cpf, nome, email, data_nascimento, senha) VALUES ('$cpf', '$name', '$email', '$birthdate', '$password')";
        
        if ($conn->query($insertQuery) === TRUE) {
            $response = "Novo registro criado com sucesso.";
        } else {
            $response = "Erro ao criar o registro: " . $conn->error;
        }
    }

    // Retorna a resposta como JSON
    echo json_encode(['message' => $response]);
}
?>



