<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href=".././assets/style.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@0,100..900;1,100..900&family=Source+Serif+4:wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
</head>
<body>
    <?php @include('../layouts/navbar.php'); ?>

    <div class="d-flex justify-content-center">
        <form id="registerForm" action="../user/user.php" method="post" enctype="multipart/form-data" onsubmit="return validateRegisterForm()">
            <div class="text-center mb-3">
                <p>Sign up with:</p>
                <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>
            </div>

            <p class="text-center">or:</p>

            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerName">Name</label>
                <input type="text" name="registerName" id="registerName" class="form-control border border-dark" style="width: 100%;" required />
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Email</label>
                <input type="email" name="registerEmail" id="registerEmail" class="form-control border border-dark" style="width: 100%;" required />
            </div>

            <!-- CPF input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerCPF">CPF</label>
                <input type="text" name="registerCPF" id="registerCPF" class="form-control border border-dark" style="width: 100%;" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerPassword">Password</label>
                <div class="input-group">
                    <input type="password" name="registerPassword" id="registerPassword" class="form-control border border-dark" style="width: 100%;" required />
                    <button class="btn border border-dark" type="button" id="togglePasswordVisibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Repeat Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                <div class="input-group">
                    <input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control border border-dark" style="width: 100%;" required />
                    <button class="btn border border-dark" type="button" id="toggleRepeatPasswordVisibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Birthdate input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerBirthdate">Data de Nascimento</label>
                <input type="date" name="registerBirthdate" id="registerBirthdate" class="form-control border border-dark" style="width: 100%;" required />
            </div>

            <!-- Photo input -->
            <div class="mb-4">
                <label for="registerPhoto" class="form-label">Photo</label>
                <input type="file" class="form-control border border-dark" id="registerPhoto" name="registerPhoto" style="width: 100%;" required>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText" required />
                <label class="form-check-label" for="registerCheck">I have read and agree to the terms</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3" style="background-color: rgb(215,90, 90);">Sign in</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Already have a account? <a href="user_login.php">Login</a></p>
            </div>
        </form>
    </div>

    <footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.querySelector('#registerPassword');
            const repeatPasswordField = document.querySelector('#registerRepeatPassword');

            const togglePasswordVisibilityButton = document.querySelector('#togglePasswordVisibility');
            const toggleRepeatVisibilityButton = document.querySelector('#toggleRepeatPasswordVisibility');

            togglePasswordVisibilityButton.addEventListener('click', function() {
                togglePasswordVisibility(passwordField, this);
            });

            toggleRepeatVisibilityButton.addEventListener('click', function() {
                togglePasswordVisibility(repeatPasswordField, this);
            });

            function togglePasswordVisibility(field, button) {
                if (field.type === 'password') {
                    field.type = 'text';
                    button.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    field.type = 'password';
                    button.innerHTML = '<i class="fas fa-eye"></i>';
                }
            }
        });

        function validateRegisterForm() {
            const nameField = document.querySelector('#registerName');
            const emailField = document.querySelector('#registerEmail');
            const passwordField = document.querySelector('#registerPassword');
            const repeatPasswordField = document.querySelector('#registerRepeatPassword');
            const birthdateField = document.querySelector('#registerBirthdate');
            const cpfField = document.querySelector('#registerCPF');
            
            const name = nameField.value.trim();
            const email = emailField.value.trim();
            const password = passwordField.value.trim();
            const repeatPassword = repeatPasswordField.value.trim();
            const birthdate = new Date(birthdateField.value);
            const eighteenYearsAgo = new Date();
            eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);
            const cpf = cpfField.value.trim();

            if (birthdate >= new Date() || birthdate > eighteenYearsAgo) {
                showAlert('Você deve ser maior de 18 anos para se registrar.', 'error');
                return false;
            }

            if (!name || name.length < 3) {
                showAlert('O nome deve ter pelo menos 3 letras.', 'error');
                return false;
            }

            if (!email || !isValidEmail(email)) {
                showAlert('Por favor, insira um endereço de e-mail válido.', 'error');
                return false;
            }

            if (!password || password.length < 6) {
                showAlert('A senha deve ter pelo menos 6 caracteres.', 'error');
                return false;
            }

            if (password !== repeatPassword) {
                showAlert('As senhas não coincidem.', 'error');
                return false;
            }

            const specialCharacterRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
            if (!specialCharacterRegex.test(password)) {
                showAlert('A senha deve conter pelo menos um caractere especial.', 'error');
                return false;
            }

            const cpfRegex = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
            if (!cpfRegex.test(cpf)) {
                showAlert('Por favor, insira um CPF válido.', 'error');
                return false;
            }

            showAlert('Cadastro realizado com sucesso!', 'success');
            return true;
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showAlert(message, icon = 'error') {
            Swal.fire({
                title: icon === 'error' ? 'Erro!' : 'Sucesso!',
                text: message,
                icon: icon,
                confirmButtonText: 'OK'
            });
        }
    </script>
</body>
</html>
