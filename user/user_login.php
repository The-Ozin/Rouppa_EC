<?php
session_start();
@include('../layouts/navbar.php');
@include('../connect.php');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST['loginName']);
        $password = trim($_POST['loginPassword']);

        // Debug: Imprimir os valores recebidos
        echo "Email recebido: " . $email . "<br>";
        echo "Senha recebida: " . $password . "<br>";

        // Debug: Log received email
        error_log("Received login request for email: " . $email);

        $sql = "SELECT cpf, email, senha FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Debug: Log password verification
            error_log("Verifying password for email: " . $email);
            if (password_verify($password, $row['senha'])) {
                $_SESSION['user_id'] = $row['cpf'];
                $_SESSION['email'] = $row['email'];
                echo json_encode(["success" => true]);
                exit();
            } else {
                header("HTTP/1.1 401 Unauthorized");
                echo json_encode(["error" => "Senha incorreta."]);
                exit();
            }
        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode(["error" => "Usuário não encontrado."]);
            exit();
        }
    }
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(["error" => "Erro no servidor."]);
} finally {
    if (isset($stmt) && $stmt !== false) {
        $stmt->close();
    }
    if (isset($conn) && $conn !== false) {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<body>
<div class="d-flex justify-content-center">
    <!-- Pills content -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form id="loginForm">
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
                    <label class="form-label" for="loginName">Email</label>
                    <input type="email" id="loginName" class="form-control border border-dark" style="width: 100%;" required/>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="loginPassword">Password</label>
                    <div class="input-group">
                        <input type="password" id="loginPassword" class="form-control border border-dark" style="width: 100%;" required />
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
    <?php @include('../layouts/footer.php');?>
</footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.querySelector('#loginForm');
            const togglePasswordBtn = document.querySelector('#toggleLoginPasswordVisibility');
            const passwordInput = document.querySelector('#loginPassword');

            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this);

                fetch('user_login.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    return response.json().then(data => {
                        if (response.ok) {
                            window.location.href = '../welcome.php';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.error,
                            });
                        }
                    });
                })
                .catch(error => {
                    console.error('Erro ao processar a solicitação:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Erro ao processar a solicitação.',
                    });
                });
            });
        });
    </script>
</body>
</html>
