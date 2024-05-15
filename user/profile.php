<?php 
 @include('../layouts/navbar.php');
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rouppa</title>
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
    </head>
    <body>
    <div class="d-flex justify-content-center">
        <form action="update_profile.php" method="POST">
            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerName">Name</label>
                <input type="text" id="registerName" name="name" class="form-control border border-dark" style="width: 100%;" required />
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerEmail">Email</label>
                <input type="email" id="registerEmail" name="email" class="form-control border border-dark" style="width: 100%;" required />
            </div>

            <!-- CPF input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerCPF">CPF</label>
                <input type="text" id="registerCPF" name="cpf" class="form-control border border-dark" style="width: 100%;" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerPassword">Password</label>
                <div class="input-group">
                    <input type="password" id="registerPassword" name="password" class="form-control border border-dark" style="width: 100%;" required />
                    <button class="btn border border-dark" type="button" id="togglePasswordVisibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Repeat Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                <div class="input-group">
                    <input type="password" id="registerRepeatPassword" name="repeat_password" class="form-control border border-dark" style="width: 100%;" required />
                    <button class="btn border border-dark" type="button" id="toggleRepeatPasswordVisibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Birthdate input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="registerBirthdate">Data de Nascimento</label>
                <input type="date" id="registerBirthdate" name="birthdate" class="form-control border border-dark" style="width: 100%;" required />
            </div>

            <!-- Photo input -->
            <div class="mb-4">
                <label for="registerPhoto" class="form-label">Photo</label>
                <div class="d-flex justify-content-center align-items-center position-relative">
                    <div class="avatar mx-auto position-relative" style="width: 120px; height: 120px;">
                        <img src="../assets/avatar.png" alt="Avatar" class="rounded-circle img-fluid">
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0;">
                            <button type="button" class="btn btn-secondary" style="opacity: 0;">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <input type="file" class="form-control border border-dark" id="registerPhoto" name="photo" style="width: 100%;">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" style="background-color: rgb(215,90, 90);">Save</button>
            </div>
            </div>
        </form>
    </div>
    <footer>
        <?php @include('../layouts/footer.php'); ?>
    </footer>
</html>

<style>
</style>