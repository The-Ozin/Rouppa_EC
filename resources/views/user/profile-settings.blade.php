@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações</title>
</head>

    <body>
        <main>
            @section('content')
            <form>
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name">Nome:</label>
                        <input type="text" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ $user->email }}" required>
                    </div>

                    <div>
                        <label for="profile_picture">Foto de Perfil:</label>
                        <input type="file" name="profile_picture">
                    </div>

                    <div>
                        <label for="password">Senha:</label>
                        <input type="password" name="password" required>
                    </div>

                    <button type="submit">Salvar Alterações</button>
                </form>
            @endsection 
        </main>
    </body>

</html>
           