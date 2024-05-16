<?php 
 @include('../layouts/navbar.php');
  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="stylesheet" href=".././assets/style.css">

        <!-- Font Awesome -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

        <!-- MDB -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css"
        rel="stylesheet"
        />

        <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
        "></script>

            <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"
            
            initMDB({ Input, Tab, Ripple });
        ></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <div class="d-flex justify-content-center">
            <form id="registerForm" action="../user/user.php" method="post">
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
                </div>

                <p class="text-center">or:</p>

                <!-- Name input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="registerName">Name</label>
                    <input type="text" name="registerName" class="form-control border border-dark" style="width: 100%;" required />
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="registerEmail">Email</label>
                    <input type="email" name="registerEmail" class="form-control border border-dark" style="width: 100%;" required />
                </div>

                <!-- CPF input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="registerCPF">CPF</label>
                    <input type="text" name="registerCPF" class="form-control border border-dark" style="width: 100%;" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required />
                </div>

                 <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="registerPassword">Password</label>
                    <div class="input-group">
                        <input type="password" name="registerPassword" class="form-control border border-dark" style="width: 100%;" required />
                        <button class="btn border border-dark" type="button" id="togglePasswordVisibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Repeat Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                    <div class="input-group">
                        <input type="password" name="registerRepeatPassword" class="form-control border border-dark" style="width: 100%;" required />
                        <button class="btn border border-dark" type="button" id="toggleRepeatPasswordVisibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Birthdate input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="registerBirthdate">Data de Nascimento</label>
                    <input type="date" name="registerBirthdate" class="form-control border border-dark" style="width: 100%;" required />
                </div>

                <!-- Photo input -->
                <div class="mb-4">
                    <label for="registerPhoto" class="form-label">Photo</label>
                    <input type="file" class="form-control border border-dark" id="registerPhoto" style="width: 100%;">
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText" required />
                    <label class="form-check-label" for="registerCheck">I have read and agree to the terms</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-3" style="background-color: rgb(215,90, 90);">Sign in</button>
                <!-- Register buttons -->
                <div class="text-center">
                            <p>Already have a account? <a href="user_login.php">Login</a></p>
                        </div>
            </form>
        </div>
        <footer>
        <?php @include('../layouts/footer.php');?>
        </footer>
    </body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.querySelector('#registerPassword');
        const repeatPasswordField = document.querySelector('#registerRepeatPassword');

        const togglePasswordVisibilityButton = document.querySelector('#togglePasswordVisibility');
        const toggleRepeatVisibilityButton = document.querySelector('#toggleRepeatPasswordVisibility');

        togglePasswordVisibilityButton.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordField.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        toggleRepeatVisibilityButton.addEventListener('click', function() {
            if (repeatPasswordField.type === 'password') {
                repeatPasswordField.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                repeatPasswordField.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });

function validateRegisterForm() {
    const nameField = document.querySelector('#registerName');
    const emailField = document.querySelector('#registerEmail');
    const passwordField = document.querySelector('#registerPassword');
    const repeatPasswordField = document.querySelector('#registerRepeatPassword');
    const birthdateField = document.querySelector('#registerBirthdate');
    const cpfField = document.querySelector('#registerCPF'); // Novo campo de CPF

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
        showAlert('Você deve ser maior de 18 anos para se registrar.', 'error');
        return false;
    }

    // Validação de nome
    if (!name || name.length < 3) {
        showAlert('O nome deve ter pelo menos 3 letras.', 'error');
        return false;
    }

    // Validação de e-mail simples
    if (!email || !isValidEmail(email)) {
        showAlert('Por favor, insira um endereço de e-mail válido.', 'error');
        return false;
    }

    // Validação de senha
    if (!password || password.length < 6) {
        showAlert('A senha deve ter pelo menos 6 caracteres.', 'error');
        return false;
    }

    // Validação de senha repetida
    if (password !== repeatPassword) {
        showAlert('As senhas não coincidem.', 'error');
        return false;
    }

    // Validação de senha contendo caractere especial
    const specialCharacterRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    if (!specialCharacterRegex.test(password)) {
        showAlert('A senha deve conter pelo menos um caractere especial.', 'error');
        return false;
    }

    // Validação de CPF com expressão regular
    const cpfRegex = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
    if (!cpfRegex.test(cpf)) {
        showAlert('Por favor, insira um CPF válido.', 'error');
        return false;
    }

    // Se todas as validações passarem, retorna verdadeiro
    return true;
}

function isValidEmail(email) {
    // Expressão regular simples para validação de e-mail
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showAlert(message, icon = 'error') {
    // Exibir alerta personalizado com SweetAlert
    Swal.fire({
        title: icon === 'error' ? 'Erro!' : 'Sucesso!',
        text: message,
        icon: icon,
        confirmButtonText: 'OK'
    });
}

function sendRegisterData() {
    // Aqui você pode enviar os dados do formulário de registro para o servidor
    // Por simplicidade, este é apenas um exemplo simulado
    showAlert('Cadastro realizado com sucesso!', 'success');
}
</script>