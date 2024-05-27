<?php
session_start();
include('../connect.php');
 // Inicia a sessão
if (!isset($_SESSION['user_name']) AND !isset($_SESSION['nome_loja'])) {
    // Redireciona o usuário de volta para a página de login
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}


@include('../layouts/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rouppa</title>
    <link rel="stylesheet" href="../assets/style.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
</head>
<body>
    <div class="sale"> ! 20% OFF EM TODA A COMPRA ! </div>
    <h1>SNKRS</h1>
    <?php @include('products_shop.php'); ?>
    <!-- Adicione a inicialização do componente do carrossel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <!-- Adicione a inicialização do componente do carrossel -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselEl = document.querySelector('#carouselExampleTouch');
            new mdb.Carousel(carouselEl, {
                touch: false
            });
        });
    </script>
    <footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>
</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');

footer{
    margin-top: 20vh;
}

.sale {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: orangered;
    font-family: 'Anton', sans-serif;
    color:black;
    font-weight: 400;
    font-size: 80px;
    height: 200px;
    width: 100%;
    margin: 0;
    position: absolute;
    top: 12vh; /* Ajusta a posição para o topo da tela */
    border: 1px solid black;

    /* Adicionando responsividade */
    padding: 20px; /* Adicionando um espaço interno para garantir que o texto não encoste nas bordas */
}

/* Media query para telas menores */
@media (max-width: 768px) {
    .sale {
        font-size: 50px; /* Reduzindo o tamanho da fonte para telas menores */
        height: 150px; /* Reduzindo a altura da faixa para telas menores */
        top: 12vh; /* Ajustando a posição superior para telas menores */
    }
}

/* Media query para telas ainda menores */
@media (max-width: 576px) {
    .sale {
        font-size: 30px; /* Reduzindo ainda mais o tamanho da fonte para telas muito pequenas */
        height: 100px; /* Reduzindo ainda mais a altura da faixa para telas muito pequenas */
        top: 12vh; /* Ajustando ainda mais a posição superior para telas muito pequenas */
    }
}

.carousel {
    margin-top: 7vh;
    width: 400px !important;
    height: 400px !important;
}

.d-block {
    width: 400px !important;
    height: 400px !important;
    object-fit: cover;
}

h1 {
    margin-top: 40vh;
    margin-left: 19vh;
    font-family: 'Anton', sans-serif;
    color: rgb(90, 29, 0);
}

</style>

<script>
    // Initialization for ES Users
import { Carousel, initMDB } from "mdb-ui-kit";

initMDB({ Carousel });
</script>