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
            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div>
                    <label for="password_confirmation">Repetir Senha:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div>
                    <label for="birthdate">Data de Nascimento:</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>

                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>

                <div>
                    <label for="photo">Adicionar Foto:</label>
                    <input type="file" id="photo" name="photo">
                </div>

                <div>
                    <button type="submit">Registrar</button>
                </div>
            </form>
        @endsection
    </main>
</body>



        
