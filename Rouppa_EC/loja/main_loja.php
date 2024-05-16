<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION["email"])) {
    // Se não estiver logado, redirecionar para a página de login
    header("Location: ../user/login_usuario.html");
    exit;
}
?>

<?php

// Definir uma variável para indicar se o usuário está logado
$usuarioLogado = false;
$nomeUsuario = "Login";

// Verificar se o usuário está logado
if(isset($_SESSION["email"])) {
    // Se estiver logado, obter o nome do usuário
    include("../connect.php");
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    $email = $_SESSION["email"];
    $sql = "SELECT nome FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomeUsuario = $row["nome"];
        // Definir a variável indicando que o usuário está logado
        $usuarioLogado = true;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../main2.css">
    <link rel="stylesheet" type="text/css" href="loja.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Loja da Rouppa</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="navbar-logo">
                <img src="loja_images/logo1.jpg" alt="logo">
            </div>
            <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../main_index/main_index1.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="men/men.html">Masculino</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="women/women.html">Feminino</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <div class="input-group">
                        <input class="form-control me-2 border-0 rounded-0" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success rounded-0" type="submit" style="background-color: white;"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Elemento para exibir o nome do usuário -->
                <li class="nav-item" id="usuario-logado">
                    <!-- Adicionando um link de logout -->
                    <a class="nav-link" href="../user/login_usuario.html"><?php echo $nomeUsuario; ?></a>
                    <!-- Link de logout -->
                    <?php if ($usuarioLogado): ?>
                        <a id="logout-link" class="nav-link" href="../user/logout.php">Logout</a>
                    <?php endif; ?>
                </li>
            </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="sale">20% OFF EM TODA A COMPRA</div>
    <div class="sections">
        <div class="section">
            <img src="loja_images/ms.jpg" alt="Men's Section">
            <div class="sm">
                <a href="men/men.html">Sessão Masculina</a>
            </div>
        </div>
        <div class="section">
            <img src="loja_images/ws.jpg" alt="Women's Section">
            <div class="sf">
                <a href="women/women.html">Sessão Feminina</a>
            </div>
        </div>
    </div>

    <div class="top_brands">Top Marcas</div>
    <div class="brand_images">
        <img src="loja_images/brands_img/nike_img.jpg" alt="nike">
        <img src="loja_images/brands_img/NB_img.jpg" alt="new balance">
        <img src="loja_images/brands_img/converse_img.jpg" alt="converse">
    </div>

    <div class="arrived">Lançamentos</div>
    <div class="arrived_images">
        <img src="loja_images/mj_img.jpg" alt="Marc Jacob">
        <img src="loja_images/as_img.jpg" alt="Acne Studios">
        <img src="loja_images/ro_img.jpg" alt="Rick Owens">
    </div>
</main>
<footer class="bg-body-tertiary text-lg-start">
    <!-- Grid container -->
    <div class="container p-4">
        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-body">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-body">Link 2</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!" class="text-body">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-body">Link 2</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>

                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-body">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-body">Link 2</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-0">Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="#!" class="text-body">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-body">Link 2</a>
                    </li>
                </ul>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2024 Copyright:
        <a class="text-body" href="http://localhost:63342/Rouppa_EC/Rouppa_EC/main_index/main_index.html">Rouppa</a>
    </div>
    <!-- Copyright -->
</footer>
</body>
</html>

