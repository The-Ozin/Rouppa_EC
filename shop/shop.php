
<?php 
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
    <div class="d-flex justify-content-center">
        <!-- Primeiro Carrossel -->
        <div id="carouselExampleTouch" class="carousel slide" data-mdb-touch="false" style="max-width: 400px; margin-right: 20px;">
            <div class="carousel-indicators">
                <button type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./shop_images/cvro1.jpg" class="d-block w-100" alt="Wild Landscape" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./shop_images/crov2.jpg" class="d-block w-100" alt="Camera" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./shop_images/crov3.jpg" class="d-block w-100" alt="Exotic Fruits" style="height: 400px; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <!-- Setas do Carrossel -->
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleTouch" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Segundo Carrossel -->
        <div id="carouselExampleTouch2" class="carousel slide" data-mdb-touch="false" style="max-width: 400px; margin-right: 20px;">
            <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselExampleTouch2" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselExampleTouch2" data-mdb-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselExampleTouch2" data-mdb-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./shop_images/yz7501.jpg" class="d-block w-100" alt="Wild Landscape" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="./shop_images/yz7502.jpg" class="d-block w-100" alt="Camera" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="./shop_images/yz7503.jpg" class="d-block w-100" alt="Exotic Fruits" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            </div>
            <!-- Setas do Carrossel -->
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleTouch2" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleTouch2" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Terceiro Carrossel -->
        <div id="carouselExampleTouch3" class="carousel slide" data-mdb-touch="false" style="max-width: 400px;">
            <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselExampleTouch3" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselExampleTouch3" data-mdb-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselExampleTouch3" data-mdb-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./shop_images/now1.jpg" class="d-block w-100" alt="Wild Landscape" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="./shop_images//now2.jpg" class="d-block w-100" alt="Camera" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="./shop_images//now3.jpg" class="d-block w-100" alt="Exotic Fruits" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            </div>
            <!-- Setas do Carrossel -->
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleTouch3" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleTouch3" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
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