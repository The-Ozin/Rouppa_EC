<?php
// Verifica se há um erro na URL
if (isset($_GET['error'])) {
    // Obtém o erro da URL e decodifica (remove os caracteres especiais)
    $error = urldecode($_GET['error']);
    // Exibe a mensagem de erro na página
    echo "<p style='color: red;'>$error</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php @include('../layouts/navbar.php'); ?>
    <div class="d-flex justify-content-center">
        <div class="form-box">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <h2 class="text-center text-white">Login de Administrador</h2>
                    <form action="adm_login_act.php" method="post" id="admLoginForm">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label text-white" for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" class="form-control border border-dark bg-white" style="width: 100%;" required/>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label text-white" for="senha">Senha:</label>
                        <div class="input-group">
                            <input type="password" id="senha" name="senha" class="form-control border border-dark" style="background-color: white;" required/>
                            <button class="btn border border-dark text-white" type="button" id="toggleAdminPasswordVisibility" style="background-color: rgb(215,90, 90);">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: rgb(215,90, 90);">Login</button>
                </form>
                    <?php if (isset($_GET['error'])): ?>
                        <p style='color: red;'><?= urldecode($_GET['error']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include('../layouts/footer.php'); ?>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const adminPasswordField = document.querySelector('input[name="senha"]');
            const toggleAdminPasswordVisibilityButton = document.querySelector('#toggleAdminPasswordVisibility');
            toggleAdminPasswordVisibilityButton.addEventListener('click', function() {
                togglePasswordVisibility(adminPasswordField, this);
            });
            function togglePasswordVisibility(field, button) {
                if (field.type === 'password') {
                    field.type = 'text';
                    button.innerHTML = '<i class="fas fa-eye-slash text-white"></i>';
                } else {
                    field.type = 'password';
                    button.innerHTML = '<i class="fas fa-eye text-white"></i>';
                }
            }
        });
    </script>
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
    </style>
</body>
</html>
