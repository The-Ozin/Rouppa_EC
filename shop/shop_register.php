<?php 
 session_start();
 @include('../layouts/navbar.php');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Loja</title>
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

    <h1>Crie sua Conta de Loja</h1>
    <div class="d-flex justify-content-center" style="color:white">
        <div class="form-box">
        <form id="registerForm" action="shop_register_act.php" method="post" enctype="multipart/form-data" onsubmit="return validateRegisterForm()">
                <div class="text-center mb-3">
                    <p>Cadastre-se com:</p>
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

                <p class="text-center">ou:</p>

                <!-- CNPJ input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerCNPJ">CNPJ</label>
                    <input type="text" name="registerCNPJ" id="registerCNPJ" class="form-control border border-dark" style="background-color: white;" required />
                </div>

                <!-- Nome da loja input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerStoreName">Nome da Loja</label>
                    <input type="text" name="registerStoreName" id="registerStoreName" class="form-control border border-dark" style="background-color: white;" required />
                </div>

                <!-- Endereço input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerAddress">Endereço</label>
                    <input type="text" name="registerAddress" id="registerAddress" class="form-control border border-dark" style="background-color: white;" required />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerPassword">Senha</label>
                    <div class="input-group">
                        <input type="password" name="registerPassword" id="registerPassword" class="form-control border border-dark" style="background-color: white;" required />
                        <button class="btn border border-dark text-white" type="button" id="togglePasswordVisibility" style="background-color: rgb(215,90, 90);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Repeat Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerRepeatPassword">Repetir senha</label>
                    <div class="input-group">
                        <input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control border border-dark" style="background-color: white;" required />
                        <button class="btn border border-dark text-white" type="button" id="toggleRepeatPasswordVisibility" style="background-color: rgb(215,90, 90);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label text-white" for="registerStorePhoto">Imagem de Perfil</label>
                    <input type="file" name="registerStorePhoto" id="registerStorePhoto" class="form-control border border-dark" style="background-color: white;" accept="image/*" />
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3" style="background-color: rgb(215,90, 90);">Cadastrar</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Já possui uma conta? <a href="shop_login.php">Faça login</a></p>
                </div>
            </form>
        </div>
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
            const cnpjField = document.querySelector('#registerCNPJ');
            const storeNameField = document.querySelector('#registerStoreName');
            const addressField = document.querySelector('#registerAddress');
            const passwordField = document.querySelector('#registerPassword');
            const repeatPasswordField = document.querySelector('#registerRepeatPassword');
            
            const cnpj = cnpjField.value.trim();
            const storeName = storeNameField.value.trim();
            const address = addressField.value.trim();
            const password = passwordField.value.trim();
            const repeatPassword = repeatPasswordField.value.trim();

            if (!cnpj) {
                showAlert('Por favor, insira o CNPJ da loja.', 'error');
                return false;
            }

            if (!storeName) {
                showAlert('Por favor, insira o nome da loja.', 'error');
                return false;
            }

            if (!address) {
                showAlert('Por favor, insira o endereço da loja.', 'error');
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

            showAlert('Cadastro de loja realizado com sucesso!', 'success');
            return true;
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

<style>
    .form-box {
        background-color: burlywood;
        width: 50%;
        height: 90%;
        padding: 10vh 10vh;
        margin-top: 5vh;
        margin-bottom: 10vh;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        opacity: 0.9;
    }

    h1 {
        color: rgb(215,90, 90);
        font-size: 50px;
        text-align: center;
        font-family: 'Noto Serif Display', serif;
        margin-top: 10vh;
        font-weight: bold;
    }

</style>

</body>
</html>
