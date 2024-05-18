<?php 
@include('../connect.php');
@include('../layouts/navbar.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = $_FILES['foto']['name'];
    $target_dir = "../shop_images/";
    $target_file = $target_dir . basename($foto);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica se o arquivo é uma imagem real ou um arquivo fake
    $check = getimagesize($_FILES['foto']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    // Verifica o tamanho do arquivo
    if ($_FILES['foto']['size'] > 500000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Permite apenas determinados formatos de arquivo
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Desculpe, apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
        $uploadOk = 0;
    }

    // Verifica se $uploadOk está definido como 0 devido a um erro
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    // Se tudo estiver ok, tenta enviar o arquivo
    } else {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO produto (nome, tamanho, descricao_, preco, foto) VALUES ('$nome', '$tamanho', '$descricao', '$preco', '$foto')";
            if (mysqli_query($conn, $sql)) {
                echo "O arquivo " . htmlspecialchars(basename($foto)). " foi enviado com sucesso.";
                echo "Novo registro criado com sucesso.";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Desculpe, ocorreu um erro ao enviar seu arquivo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="stylesheet" href=".././assets/style.css">

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="d-flex justify-content-center">
        <form id="productForm" action="product_register.php" method="post" enctype="multipart/form-data">
            <h1 class="text-center">Cadastro de Produto</h1>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productName">Nome:</label>
                <input type="text" id="productName" name="productName" class="form-control border border-dark" required>
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productCategory">Categoria:</label>
                <select id="productCategory" name="productCategory" class="form-select border border-dark" required>
                    <option value="" disabled selected>Selecione a categoria</option>
                    <option value="roupa">Roupa</option>
                    <option value="calcado">Calçado</option>
                    <option value="acessorios">Acessórios</option>
                </select>
            </div>


            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productSize">Tamanho:</label>
                <input type="text" id="productSize" name="productSize" class="form-control border border-dark" required>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productDescription">Descrição:</label>
                <textarea id="productDescription" name="productDescription" class="form-control border border-dark" required></textarea>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productPrice">Preço:</label>
                <input type="text" id="productPrice" name="productPrice" class="form-control border border-dark" required>
            </div>

            <div class="mb-4">
                <label class="form-label" for="productPhoto">Foto:</label>
                <input type="file" id="productPhoto" name="productPhoto" class="form-control border border-dark" required>
            </div>

            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-3" style="background-color: rgb(215,90, 90);">Cadastrar Produto</button>
        </form>
    </div>
    <footer>
        <?php @include('../layouts/footer.php');?>
    </footer>
</body>

</html>