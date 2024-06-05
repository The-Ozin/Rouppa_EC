<?php
session_start();

include('../connect.php');
if (!isset($_SESSION['user_name'])) {
    header('Location: http://localhost/Rouppa_EC/user/user_login.php');
    exit();
}
@include('../layouts/navbar.php');
$cpf = $_SESSION['cpf'];
$query = "SELECT nome, email, foto FROM usuario WHERE cpf = '$cpf'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$_SESSION['foto'] = $user['foto'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Perfil</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:ital,wght@0,100..900;1,100..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container mt-5">
        <a href="../welcome.php"><img src="../assets/images/logo1.jpg" alt="Rouppa" class="logo"></a>
            <h1 class="text-center">Editar Perfil</h1>
            <div class="form-box">
                <form action="edit_user.php" method="post" id="editProfileForm" enctype="multipart/form-data">
                    <input type="hidden" name="update_user" value="1">
                    <div class="mb-3 text-center position-relative">
                        <?php if (!empty($_SESSION['foto'])): ?>
                            <?php $avatarPath = 'http://localhost/Rouppa_EC/pfp/' . basename($_SESSION['foto']); ?>
                            <img src="<?php echo $avatarPath; ?>" class="rounded-circle profile-img" id="profileImage" height="150" width="150" alt="Foto de Perfil" loading="lazy">
                        <?php endif; ?>
                        <div class="edit-icon" onclick="document.getElementById('editFoto').click();">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                    <div class="mb-3 d-none">
                        <label for="editFoto" class="form-label" style="color: white;">Foto de Perfil</label>
                        <input type="file" class="form-control" id="editFoto" name="foto">
                        <input type="hidden" name="foto_atual" value="<?php echo htmlspecialchars($user['foto']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editNome" class="form-label" style="color: white;">Nome</label>
                        <input type="text" class="form-control" id="editNome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label" style="color: white;">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editSenha" class="form-label" style="color: white;">Nova Senha</label>
                        <div class="input-group">
                            <input type="password" class="form-control border border-dark" id="editSenha" name="senha">
                            <button class="btn border border-dark text-white" type="button" id="toggleNewPasswordVisibility" style="background-color: rgb(215, 90, 90);">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="background-color: rgb(215,90, 90)">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function showAlert(message, type) {
            Swal.fire({
                title: type === 'error' ? 'Erro!' : 'Sucesso!',
                text: message,
                icon: type,
                confirmButtonText: 'OK'
            });
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validatePassword(senha) {
            const passwordRegex = /^(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{6,}$/;
            return passwordRegex.test(senha);
        }

        document.getElementById('toggleNewPasswordVisibility').addEventListener('click', function() {
            const passwordField = document.getElementById('editSenha');
            const icon = this.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('editProfileForm').addEventListener('submit', function(event) {
            const nome = document.getElementById('editNome').value;
            const email = document.getElementById('editEmail').value;
            const senha = document.getElementById('editSenha').value;

            if (!validateEmail(email)) {
                showAlert('Por favor, insira um email válido.', 'error');
                event.preventDefault();
                return;
            }

            if (senha.trim() !== '' && !validatePassword(senha)) {
                showAlert('A senha deve ter pelo menos 6 caracteres, incluindo pelo menos uma letra minúscula, um número e um caractere especial.', 'error');
                event.preventDefault();
                return;
            }
        });

        // Mostrar a visualização da nova foto do perfil
        document.getElementById('editFoto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
    </script>
</body>
<footer>
        <?php include('../layouts/footer.php'); ?>
</footer>
</html>
<style>
    h1 {
        color: rgb(215, 90, 90);
        text-align: center;
        margin-top: -10vh;
        font-weight: bold;
        font-family: 'Noto Serif Display', serif;
    }
    .logo {
        width: 200px;
        height: 200px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 10vh;
        transform: translateY(-50%);
    }
    .form-box {
        background-color: burlywood;
        width: 80%;
        height: 90%;
        padding: 10vh 10vh;
        margin: 0 auto; 
        margin-top: 5vh;
        margin-bottom: 10vh;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        opacity: 0.9;
        font-size: 18px;
    }
    .profile-img {
        position: relative;
    }
    .edit-icon {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 24px;
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 10px;
    }
    .profile-img:hover + .edit-icon {
        display: block;
    }
    .edit-icon:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }
</style>



