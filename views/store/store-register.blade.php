@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Lojas</title>
</head>

<body>
    <main>
        @section('content')
            <form id="registerForm" method="POST" enctype="multipart/form-data" action="../welcome.blade.php">
                @csrf

                <div>
                    <label for="name">Nome da Loja:</label>
                    <input type="text" id="name" name="name" pattern=".{2,}" title="O nome da loja deve conter no mínimo 2 caracteres" required>
                    <span id="nameError" style="color: red;"></span>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <span id="emailError" style="color: red;"></span>
                </div>

                <div>
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="A senha deve conter pelo menos 8 caracteres, incluindo pelo menos uma letra, um número e um caractere especial" required>
                    <span id="passwordError" style="color: red;"></span>
                </div>

                <div>
                    <label for="password_confirmation">Repetir Senha:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    <span id="confirmPasswordError" style="color: red;"></span>
                </div>

                <div>
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" id="cnpj" name="cnpj" pattern="\d{2}\.?\d{3}\.?\d{3}/?\d{4}-?\d{2}" title="O CNPJ deve estar no formato 00.000.000/0000-00 ou 00000000000000" required>
                    <span id="cnpjError" style="color: red;"></span>
                </div>

                <div>
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" pattern="\d{5}-?\d{3}" title="O CEP deve estar no formato 00000-000" required>
                    <span id="cepError" style="color: red;"></span>
                </div>

                <div>
                    <label for="photo">Adicionar Logo:</label>
                    <input type="file" id="photo" name="photo">
                </div>

                <div>
                    <button type="submit">Registrar Loja</button>
                </div>
            </form>

            <script>
                function validateForm() {
                    var name = document.getElementById("name").value;
                    var email = document.getElementById("email").value;
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("password_confirmation").value;
                    var cnpj = document.getElementById("cnpj").value;
                    var cep = document.getElementById("cep").value;

                    var isValid = true;

                    // Validate name
                    if (name.length < 2) {
                        document.getElementById("nameError").innerText = "O nome da loja deve conter no mínimo 2 caracteres";
                        isValid = false;
                    } else {
                        document.getElementById("nameError").innerText = "";
                    }

                    // Validate email
                    if (!validateEmailFormat(email)) {
                        document.getElementById("emailError").innerText = "O email deve ser válido";
                        isValid = false;
                    } else {
                        document.getElementById("emailError").innerText = "";
                    }

                    // Validate password
                    if (!validatePasswordFormat(password)) {
                        document.getElementById("passwordError").innerText = "A senha deve conter pelo menos 8 caracteres, incluindo pelo menos uma letra, um número e um caractere especial";
                        isValid = false;
                    } else {
                        document.getElementById("passwordError").innerText = "";
                    }

                    // Validate confirm password
                    if (password !== confirmPassword) {
                        document.getElementById("confirmPasswordError").innerText = "As senhas não coincidem";
                        isValid = false;
                    } else {
                        document.getElementById("confirmPasswordError").innerText = "";
                    }

                    // Validate CNPJ
                    if (!validateCNPJFormat(cnpj)) {
                        document.getElementById("cnpjError").innerText = "O CNPJ deve estar no formato 00.000.000/0000-00 ou 00000000000000";
                        isValid = false;
                    } else {
                        document.getElementById("cnpjError").innerText = "";
                    }

                    // Validate CEP
                    if (!validateCEPFormat(cep)) {
                        document.getElementById("cepError").innerText = "O CEP deve estar no formato 00000-000 ou 00000000";
                        isValid = false;
                    } else {
                        document.getElementById("cepError").innerText = "";
                    }

                    return isValid;
                }

                function validateEmailFormat(email) {
                    var emailRegex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                    return emailRegex.test(email);
                }

                function validatePasswordFormat(password) {
                    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                    return passwordRegex.test(password);
                }

                function validateCNPJFormat(cnpj) {
                    var cnpjRegex = /^\d{2}\.?\d{3}\.?\d{3}\/?\d{4}-?\d{2}$/;
                    return cnpjRegex.test(cnpj);
                }

                function validateCEPFormat(cep) {
                    var cepRegex = /^\d{5}-?\d{3}$/;
                    return cepRegex.test(cep);
                }
                
                document.getElementById("registerForm").addEventListener("submit", function(e) {
                    if (!validateForm()) {
                        e.preventDefault();
                    } else {

                        window.location.href = "welcome.blade.php";
                    }
                });
            </script>
        @endsection
    </main>
</body>
</html>
