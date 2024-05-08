
@extends('layouts.app')

<!-- CSS da Home -->
<style>
    .title {
        color: rgb(215,90, 90);
        font-family: 'Noto Serif Display', serif;
        font-weight: bold;
        font-style: italic;
        text-align: center; /* Centraliza o texto horizontalmente */
        position: absolute;
        top: 50%; /* Centraliza o texto verticalmente */
        left: 50%;
        transform: translate(-50%, -50%); /* Ajusta a posição para o centro exato */
        margin-top: -20vh;
    }

    .Rouppa {
        font-size: 200px;
    }

    .opcoes-container {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: 60vh;
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: center;
        gap: 80px;
    }


    .opcao {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 20px;
        background-color: rgb(90, 29, 0)!important;
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .opcao:hover {
        transform: scale(1.05);
    }

    .opcao img {
        width: 450px;
        height: 600px;
        margin-bottom: 20px;
    }

    .opcao h2 {
        font-family: 'Noto Serif Display', serif;
        color: white;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .opcao a {
        text-decoration: none;
    }

    .opcao p {
        color: white;
        font-size: 18px;
        text-align: center;
        font-family: 'Noto Serif Display', serif;
    }

</style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rouppa</title>
    </head>
    <body>
        <main>
            @section('content')
                <div class="title">
                    <h1 class="Rouppa">Rouppa</h1>
                    <br>
                    <h3>O que você quer vestir ?</h3>
                    <!-- Adicione o conteúdo da sua página aqui -->
                </div>
                <div class="opcoes-container">
                    <div class="opcao">
                        <a href="../loja/main_loja.html">
                            <img src="{{ asset('images\loja_img.jpg') }}" alt="Loja">
                            <h2>Loja</h2>
                            <p>Explore nossa coleção exclusiva</p>
                        </a>
                    </div>
                    <div class="opcao">
                        <a href="../brecho/main_brecho.html">
                            <img src="{{ asset('images\brecho_img.jpg') }}" alt="Brechó">
                            <h2>Brechó</h2>
                            <p>Encontre peças únicas com história dos usuários</p>
                        </a>
                    </div>
                </div>  
            @endsection 
        </main> 
    </body>
</html> 



