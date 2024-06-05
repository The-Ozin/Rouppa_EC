<?php
session_start();
include('../connect.php');

if (!isset($_SESSION['user_name'])) {
    header("Location: http://localhost/Rouppa_EC/user/user_login.php");
    exit();
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

@include('../layouts/navbar.php');

$logradouro = '';
$bairro = '';
$cidade = '';
$estado = '';

// Consulta o endereço apenas se o CEP for fornecido
if (isset($_POST['buscar_endereco']) && isset($_POST['cep'])) {
    $cep = $_POST['cep'];
    $endereco = consultarCEP($cep);

    // Verifica se o endereço foi encontrado
    if ($endereco) {
        // Armazena os dados do endereço em variáveis
        $logradouro = $endereco['logradouro'];
        $bairro = $endereco['bairro'];
        $cidade = $endereco['localidade'];
        $estado = $endereco['uf'];
    }
}

// Função para fazer uma requisição HTTP para a API ViaCEP
function consultarCEP($cep) {
    $url = "https://viacep.com.br/ws/{$cep}/json/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Erro ao consultar o CEP: ' . curl_error($ch);
        return false;
    }
    curl_close($ch);
    $data = json_decode($response, true);
    if (isset($data['erro'])) {
        echo 'CEP não encontrado';
        return false;
    }
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="../assets/style.css">

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
    <script>
        function buscarEndereco() {
            var cep = document.getElementById('cep').value;
            if (cep) {
                var url = `https://viacep.com.br/ws/${cep}/json/`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('rua').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'CEP não encontrado',
                                text: 'Por favor, insira um CEP válido.',
                                confirmButtonColor: 'rgb(215,90,90)'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro ao consultar o CEP',
                            text: 'Verifique se o CEP informado é válido.',
                            confirmButtonColor: 'rgb(215,90,90)'
                        });
                    });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Por favor, insira um CEP',
                    confirmButtonColor: 'rgb(215,90,90)'
                });
            }
        }
    </script>
</head>
<body>
    <div class="board d-flex justify-content-center">
        <div class="user-info">
            <h2>Informações do Usuário</h2>
            <!-- Formulário para as informações do usuário e endereço -->
            <form action="processar_pedido.php" method="post">
                <!-- Campos para as informações do usuário -->
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $_SESSION['user_name']; ?>" readonly>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>

                <!-- Campos para o endereço -->
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" required>
                <button type="button" onclick="buscarEndereco()">Buscar Endereço</button>
                <label for="rua">Rua:</label>
                <input type="text" id="rua" name="rua" required>
                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" required>
                <label for="complemento">Complemento:</label>
                <input type="text" id="complemento" name="complemento">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" required>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" required>
                
                <button type="submit" style background-color=" color: rgb(215,90, 90);">Finalizar Pedido</button>
            </form>
        </div>
        <div class="order-summary">
            <h2>Resumo do Pedido</h2>
            <!-- Lista dos itens no carrinho -->
            <ul>
    <?php
    $total = 0; // Inicializa o total do pedido

    // Loop pelos itens do carrinho
    foreach ($_SESSION['cart'] as $prod_id => $quantidade) {
        // Consulta SQL para obter as informações do produto
        $query = "SELECT nome, preco FROM produto WHERE prod_id = $prod_id";
        $result = mysqli_query($conn, $query);

        // Verifica se a consulta foi bem-sucedida e se há resultados
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nome = $row['nome'];
            $preco = $row['preco'];
            $subtotal = $preco * $quantidade; // Calcula o subtotal do item
            $total += $subtotal; // Adiciona o subtotal ao total do pedido

            // Exibe as informações do item
            echo "<li>$nome - Quantidade: $quantidade - Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "</li>";
        }
    }
    ?>
</ul>
<!-- Exibir o total do pedido -->
<p>Total: <?php echo 'R$ ' . number_format($total, 2, ',', '.'); ?></p>
        </div>
    </div>
    <footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>
</body>
</html>

<style>
.board {
    display: flex;
    justify-content: space-between;
    margin: 20vh;
}

.user-info,
.order-summary {
    flex-basis: 45%;
    background-color: burlywood;
}

.user-info {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: burlywood;
}

.order-summary {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h2 {
    margin-top: 0;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px 20px;
    background-color: rgb(215,90, 90);
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: rgb(90, 29, 0)
}

/* Estilos específicos para o resumo do pedido */
.order-summary ul {
    list-style-type: none;
    padding: 0;
}

.order-summary ul li {
    margin-bottom: 10px;
}

.order-summary ul li:last-child {
    margin-bottom: 0;
}

.order-summary p {
    font-weight: bold;
}


/* Responsividade */
@media screen and (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center; /* Centraliza as divs verticalmente */
    }

    .user-info,
    .order-summary {
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>
