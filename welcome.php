 <?php 
 session_start();
 @include('./layouts/navbar.php');
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rouppa</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="icon" href="/favicon_io/favicon-16x16.png" type="image/png">

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
            <h1 class="titulo">Rouppa</h1>
            <br>
            <h3 class="frase">O que você quer vestir ?</h3>

        <div class="opcoes-container">
            <div class="opcao">
                <a href="./shop/shop.php">
                    <img src="./assets/images/loja_img.jpg" alt="Loja">
                    <h2>Loja</h2>
                    <p>Explore nossa coleção exclusiva</p>
                </a>
            </div>
            <div class="opcao">
                <a href="./user/brecho.php">
                    <img src="./assets/images/brecho_img.jpg" alt="Brechó">
                    <h2>Brechó</h2>
                    <p>Encontre peças únicas com história dos usuários</p>
                </a>
            </div>
        </div>
        <footer>
            <?php 
            @include('./layouts/footer.php');
            ?>
        </footer>
    </body>
</html>



<style>

.titulo {
    font-family: 'Noto Serif Display', serif;
    text-align: center;
    font-size: 200px;
    color: rgb(215, 90, 90);
    margin-top: 20px;
    font-style: italic;
}

.frase {
    font-family: 'Noto Serif Display', serif;
    text-align: center;
    font-size: 30px;
    color: rgb(215, 90, 90);
}


.opcoes-container {
    display: flex;
    justify-content: center;
    gap: 80px;
    flex-wrap: wrap; 
    margin-top: 20vh;
}


.opcao {
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
    max-width: 450px; 
}

.opcao:hover {
    transform: scale(1.05);
}

.opcao img {
    width: 100%; 
    height: auto;
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

footer {
    margin-top: 20vh;
}

@media (max-width: 768px) {
    .titulo {
        font-size: 100px;
    }

    .frase {
        font-size: 20px;
    }

    .opcoes-container {
        flex-direction: column;
        align-items: center;
        margin-top: 20vh;
        gap: 20px; 
    }

    .opcao {
        width: 100%;
        margin-bottom: 20px;
        max-width: none; 
    }

    .opcao img {
        width: 100%; 
        height: auto;
    }

    footer {
        margin-top: 20vh;
    }
}


</style>



