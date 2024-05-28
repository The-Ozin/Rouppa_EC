<?php 
 session_start();
 @include('../layouts/navbar.php');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Loja</title>
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
    <div class="d-flex justify-content-center">
        <div class="form-box">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="shop_login_act.php" method="post" id="loginForm">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label text-white" for="cnpj">CNPJ</label>
                            <input type="text" name="cnpj" class="form-control border border-dark bg-white" style="width: 100%;" required/>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label text-white" for="senha">Senha</label>
                            <div class="input-group">
                                <input type="password" name="senha" id="senha" class="form-control border border-dark" style="background-color: white;" required />
                                <button class="btn border border-dark text-white" type="button" id="togglePasswordVisibility" style="background-color: rgb(215,90, 90);">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="form-check mb-3 mb-md-0">
                                    <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked>
                                    <label class="form-check-label text-white" for="loginCheck"> Lembrar-me </label>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="#!" class="text-white">Esqueceu a senha?</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: rgb(215,90, 90);">Entrar</button>
                        <div class="text-center">
                            <p class="text-white">Ainda não é membro? <a href="shop_register.php">Registrar</a></p>
                            <p class="text-white">Gostaria de entrar como usuário? <a href="http://localhost/Rouppa/user/user_login.php">Entrar como usuário</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include('../layouts/footer.php'); ?>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginPasswordField = document.querySelector('input[name="senha"]');
            const toggleLoginPasswordVisibilityButton = document.querySelector('#togglePasswordVisibility');
            toggleLoginPasswordVisibilityButton.addEventListener('click', function() {
                togglePasswordVisibility(loginPasswordField, this);
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
            background-color: burlywood;
            width: 50%;
            height: auto;
            padding: 5vh 5vh;
            margin-top: 5vh;
            margin-bottom: 10vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            opacity: 0.9;
            border-radius: 15px;
        }
    </style>
</body>
</html>
