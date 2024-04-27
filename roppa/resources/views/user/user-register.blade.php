User
@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Cadastro</title>
</head>

<body>
    <main>
        @section('content')
            <form id="registerForm" method="POST" enctype="multipart/form-data" action="../welcome.blade.php">
                @csrf

                <div>
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" pattern=".{2,}" title="O nome deve conter no mínimo 2 caracteres" required>
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
                    <label for="birthdate">Data de Nascimento:</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                    <span id="birthdateError" style="color: red;"></span>
                </div>

                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-?\d{2}" title="O CPF deve estar no formato 000.000.000-00 ou 00000000000" required>
                    <span id="cpfError" style="color: red;"></span>
                </div>

                <div>
                    <label for="photo">Adicionar Foto:</label>
                    <input type="file" id="photo" name="photo">
                </div>

                <div>
                    <button type="submit">Registrar</button>
                </div>
            </form>

            <script>
                function validateForm() {
                    var name = document.getElementById("name").value;
                    var email = document.getElementById("email").value;
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("password_confirmation").value;
                    var birthdate = document.getElementById("birthdate").value;
                    var cpf = document.getElementById("cpf").value;

                    var isValid = true;

                    // Validate name
                    if (name.length < 2) {
                        document.getElementById("nameError").innerText = "O nome deve conter no mínimo 2 caracteres";
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

                    // Validate birthdate
                    if (!validateBirthdateFormat(birthdate)) {
                        document.getElementById("birthdateError").innerText = "Insira uma data válida";
                        isValid = false;
                    } else {
                        document.getElementById("birthdateError").innerText = "";
                    }

                    // Validate CPF
                    if (!validateCPFFormat(cpf)) {
                        document.getElementById("cpfError").innerText = "O CPF deve estar no formato 000.000.000-00 ou 00000000000";
                        isValid = false;
                    } else {
                        document.getElementById("cpfError").innerText = "";
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

                function validateBirthdateFormat(birthdate) {
                    var birthdateObj = new Date(birthdate);
                    var today = new Date();
                    
                    // Verificar se a data de nascimento está no futuro
                    if (birthdateObj > today) {
                        document.getElementById("birthdateError").innerText = "A data de nascimento não pode ser no futuro";
                        return false;
                    }

                    var age = today.getFullYear() - birthdateObj.getFullYear();
                    var monthDiff = today.getMonth() - birthdateObj.getMonth();
                    
                    // Ajustar a idade se o mês atual for anterior ao mês de nascimento ou se estiver no mesmo mês mas o dia atual for anterior ao dia de nascimento
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdateObj.getDate())) {
                        age--;
                    }

                    // Verificar se o usuário tem menos de 18 anos
                    if (age < 18) {
                        document.getElementById("birthdateError").innerText = "Você deve ser maior de 18 anos para se registrar";
                        return false;
                    }

                    // Se todas as condições forem atendidas, a data é considerada válida
                    return true;
                }

                function validateCPFFormat(cpf) {
                    var cpfRegex = /^\d{3}\.?\d{3}\.?\d{3}-?\d{2}$/;
                    return cpfRegex.test(cpf);
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