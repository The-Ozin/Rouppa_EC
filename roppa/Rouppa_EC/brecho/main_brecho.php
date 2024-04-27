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
    <title>Brechó da Rouppa</title>
    <link rel="stylesheet" href="../main2.css">
    <link rel="stylesheet" href="brecho.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="navbar-logo">
                <img src="brecho_img/logo1.jpg" alt="logo">
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
                        <a class="nav-link" href="#">Link</a>
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
                        <a class="nav-link" href="./cad_produto.html">Postar Produto</a>
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
    <div class="container">
        <h1>Produtos</h1>
        <div id="produtosContainer" class="row">
            <!-- Produtos serão exibidos aqui -->
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Função para carregar os produtos da API
    function carregarProdutos() {
        axios.get('/caminho/para/seu/arquivo/php/que/retorna/produtos.php')
            .then(function (response) {
                // Limpa o conteúdo atual dos produtosContainer
                document.getElementById('produtosContainer').innerHTML = '';

                // Itera sobre os produtos recebidos da API
                response.data.forEach(function (produto) {
                    // Cria um elemento de div para cada produto
                    var produtoDiv = document.createElement('div');
                    produtoDiv.classList.add('col-md-4', 'mb-4');

                    // Monta o HTML do produto
                    var produtoHTML = `
                        <div class="card">
                            <img src="../imagens/produtos/${produto.imagem}" class="card-img-top" alt="${produto.nome}">
                            <div class="card-body">
                                <h5 class="card-title">${produto.nome}</h5>
                                <p class="card-text">${produto.descricao}</p>
                                <p class="card-text">Preço: R$ ${produto.preco}</p>
                                <a href="#" class="btn btn-primary">Comprar</a>
                            </div>
                        </div>
                    `;

                    // Define o HTML do elemento de div do produto
                    produtoDiv.innerHTML = produtoHTML;

                    // Adiciona o elemento de div do produto ao container de produtos
                    document.getElementById('produtosContainer').appendChild(produtoDiv);
                });
            })
            .catch(function (error) {
                console.error('Erro ao carregar produtos:', error);
            });
    }

    // Chama a função para carregar os produtos ao carregar a página
    carregarProdutos();
</script>
</body>
</html>





