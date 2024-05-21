<?php 
include('../layouts/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href=".././assets/style.css">

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
    <!-- Pills content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form action="user_login_act.php" method="post" id="loginForm">
                <div class="text-center mb-3">
                    <p>Sign in with:</p>
                    <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button data-mdb-ripple-init type="button" class="btn btn-secondary btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                </div>

                <p class="text-center">or:</p>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control border border-dark" style="width: 100%;" required/>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="senha">Password</label>
                    <div class="input-group">
                        <input name="senha" type="password" class="form-control border border-dark" style="width: 100%;" required />
                        <button class="btn border border-dark" type="button" id="toggleLoginPasswordVisibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <!-- 2 column grid layout -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked>
                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: rgb(215,90, 90);">Sign in</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="user_register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

    <footer>
        <?php include('../layouts/footer.php');?>
    </footer>
</body>
</html>
