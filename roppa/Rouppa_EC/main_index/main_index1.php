<?php
session_start();

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
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../main1.css">
    <link rel="stylesheet" href="main_index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="navbar-logo">
                    <img src="./imagens/logo1.jpg" alt="logo">
                </div>
                <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./main_index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sessões
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/Rouppa_EC/loja/main_loja.html">Action</a></li>
                                <li><a class="dropdown-item" href="/Rouppa_EC/brecho/main_brecho.html">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                        <!-- Elemento para exibir o nome do usuário -->
                        <li class="nav-item" id="usuario-logado"></li>
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
        </nav>
    </header>
    <main>
        <h1 class="titulo">Rouppa</h1>
        <br>
        <h3 class="frase">O que você quer vestir ?</h3>
        <br>
        <div class="opcoes-container">
            <div class="opcao">
                <a href="../loja/main_loja.php">
                    <img src="./imagens/loja_img.jpg" alt="Imagem Loja">
                    <h2>Loja</h2>
                    <p>Explore nossa coleção exclusiva</p>
                </a>
            </div>
            <div class="opcao">
                <a href="../brecho/main_brecho.php">
                    <img src="./imagens/brecho_image.jpg" alt="Imagem Brechó">
                    <h2>Brechó</h2>
                    <p>Encontre peças únicas com história dos usuários</p>
                </a>
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
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            // Função para fazer a requisição AJAX
            function carregarNomeUsuario() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var resposta = xhr.responseText;
                            // Divide a resposta nos dados da sessão e no nome do usuário
                            var dados = resposta.split(' ');
                            var nomeUsuario = dados[1];
                            // Atualiza o conteúdo do elemento com o nome do usuário
                            document.getElementById('usuario-logado').textContent = nomeUsuario;
                        } else {
                            console.error('Ocorreu um erro ao carregar o nome do usuário.');
                        }
                    }
                };
                xhr.open('GET', '../user/verificar_sessao.php', true);
                xhr.send();
            }
    
            // Chama a função para carregar o nome do usuário quando a página é carregada
            carregarNomeUsuario();
        });
    </script>                
</body>
</html>