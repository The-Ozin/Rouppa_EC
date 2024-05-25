<?php @include('../layouts/navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex justify-content-center">
        <form id="productForm" action="product_register_act.php" method="post" enctype="multipart/form-data">
            <h1 class="text-center">Cadastro de Produto</h1>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productName">Nome:</label>
                <input type="text" id="productName" name="nome" class="form-control border border-dark" required>
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
                <input type="text" id="productSize" name="tamanho" class="form-control border border-dark" required>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productDescription">Descrição:</label>
                <textarea id="productDescription" name="descricao" class="form-control border border-dark" required></textarea>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productPrice">Preço:</label>
                <input type="text" id="productPrice" name="preco" class="form-control border border-dark" required>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productCondition">Condição de Uso:</label>
                <select id="productCondition" name="condicao_uso" class="form-select border border-dark" required>
                    <option value="1">Novo</option>
                    <option value="0">Usado</option>
                </select>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productState">Estado da Peça:</label>
                <input type="text" id="productState" name="estado_peca" class="form-control border border-dark" required>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="productStore">Loja (CNPJ):</label>
                <input type="text" id="productStore" name="fk_loja_cnpj" class="form-control border border-dark" required>
            </div>

            <div class="mb-4">
                <label class="form-label" for="productPhotos">Fotos:</label>
                <input type="file" id="productPhotos" name="fotos[]" class="form-control border border-dark" multiple required>
            </div>


            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-3" style="background-color: rgb(215,90, 90);">Cadastrar Produto</button>
        </form>
    </div>
    <footer>
        <?php @include('../layouts/footer.php');?>
    </footer>

    <style>
    .form-box {
        background-color: rgb(90, 29, 0);
        width: 50%;
        height: 90%;
        padding: 10vh 10vh;
        margin-top: 5vh;
        margin-bottom: 10vh;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        opacity: 0.9;
    }

    h1 {
        color: rgb(215,90, 90);
        font-size: 50px;
        text-align: center;
        font-family: 'Noto Serif Display', serif;
        margin-top: 10vh;
        font-weight: bold;
    }

</style>
</body>
</html>