<?php 
 session_start();
 @include('../layouts/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js" initMDB({ Input, Tab, Ripple });></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-box {
            background-color: burlywood !important;
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            margin-bottom: 10vh;  
        }

        .profile-photo {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-photo .avatar {
            position: relative;
            display: inline-block;
        }

        .profile-photo .avatar img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #d75858;
        }

        .profile-photo .avatar .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            text-align: center;
            line-height: 30px;
            border-radius: 0 0 50% 50%;
            display: none;
        }

        .profile-photo .avatar:hover .overlay {
            display: block;
        }

        .profile-photo input[type="file"] {
            display: none;
        }

        .profile-photo label {
            display: inline-block;
            margin-top: 10px;
            background-color: #d75858;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
        }

        .form-header h2 {
            color: #d75858;
            margin-bottom: 30px;
            font-size: 50px;
            font-family: 'Noto Serif Display', serif;
            font-weight: bold;
            margin-top: 5vh;
        }                               

    </style>
</head>
<body>
    <div class="form-header text-center">
        <h2>Editar Perfil</h2>
    </div>
    <div class="form-box">
        <div class="profile-photo">
            <div class="avatar">
                <img src="../assets/avatar.png">
                <div class="overlay">
                    <button type="button"><i class="fas fa-pencil-alt"></i></button>
                </div>
            </div>
            <label for="registerPhoto">Change Photo</label>
            <input type="file" class="form-control mt-2" id="registerPhoto" name="photo">
        </div>
                <!-- Name input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerName">Nome</label>
                    <input type="text" name="registerName" id="registerName" class="form-control border border-dark" style="background-color: white;" required />
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerEmail">Email</label>
                    <input type="email" name="registerEmail" id="registerEmail" class="form-control border border-dark" style="background-color: white;" required />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerPassword">Nova Senha</label>
                    <div class="input-group">
                        <input type="password" name="registerPassword" id="registerPassword" class="form-control border border-dark" style="background-color: white;" required />
                        <button class="btn border border-dark text-white" type="button" id="togglePasswordVisibility" style="background-color: rgb(215,90, 90);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Old Password -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerRepeatPassword">Senha antiga</label>
                    <div class="input-group">
                        <input type="password" name="registerRepeatPassword" id="registerRepeatPassword" class="form-control border border-dark" style="background-color: white;" required />
                        <button class="btn border border-dark text-white" type="button" id="toggleRepeatPasswordVisibility" style="background-color: rgb(215,90, 90);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Birthdate input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label text-white" for="registerBirthdate">Data de Nascimento</label>
                    <input type="date" name="registerBirthdate" id="registerBirthdate" class="form-control border border-dark" style="background-color: white;" required />
                </div>
                <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: #d75858;">Save</button>
            </div>
        </form>
    <footer>
        <?php include('../layouts/footer.php'); ?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function togglePasswordVisibility(buttonId, inputId) {
            const passwordField = document.getElementById(inputId);
            const passwordFieldType = passwordField.getAttribute('type');
            const newPasswordFieldType = passwordFieldType === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', newPasswordFieldType);

            const button = document.getElementById(buttonId);
            const icon = button.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
            togglePasswordVisibility('togglePasswordVisibility', 'registerPassword');
        });

        document.getElementById('toggleRepeatPasswordVisibility').addEventListener('click', function() {
            togglePasswordVisibility('toggleRepeatPasswordVisibility', 'registerRepeatPassword');
        });
    </script>
</body>
</html>