@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
</head>

<body>
    <main>
        @section('content')
            <form id="adminRegisterForm" method="POST" enctype="multipart/form-data" action="../welcome.blade.php">
                @csrf

                <div>
                    <label for="admin_id">ID do Administrador:</label>
                    <input type="text" id="admin_id" name="admin_id" required>
                </div>

                <div>
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" pattern="[A-Za-z\s]{2,}" title="O nome deve conter apenas letras e espaços, com no mínimo 2 caracteres" required>
                </div>

                <div>
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="A senha deve conter pelo menos uma letra e um número, com no mínimo 8 caracteres" required>
                </div>

                <div>
                    <label for="password_confirmation">Repetir Senha:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                    <span id="passwordMatchError" style="color: red;"></span>
                </div>

                <div>
                    <button type="submit" id="submitButton">Registrar Administrador</button>
                </div>
            </form>

            <script>
                document.getElementById("adminRegisterForm").addEventListener("submit", function(e) {
                    if (!validatePasswords()) {
                        e.preventDefault();
                    }
                });

                function validatePasswordFormat(password) {
                    var passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                    return passwordRegex.test(password);
                }

                function validatePasswords() {
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("password_confirmation").value;

                    if (password !== confirmPassword) {
                        document.getElementById("passwordMatchError").innerText = "As senhas não coincidem";
                        return false;
                    } else {
                        document.getElementById("passwordMatchError").innerText = "";
                        return true;
                    }
                }
            </script>
        @endsection
    </main>
</body>
</html>
