<?php
include("../connect.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$data_nsc = $_POST["data"];
$senha = md5($_POST["senha"]);
$cpf = $_POST["cpf"];

$sql_verificar_email = "SELECT * FROM usuario WHERE email = '$email'";
$result_verificar_email = $conn->query($sql_verificar_email);

if ($result_verificar_email->num_rows > 0) {
?>
    <script>
        alert("Este e-mail já está cadastrado. Por favor, escolha outro e-mail.");
        window.location.href = "cadastro_user.html";
    </script>
<?php
    exit();
}

$sql = "INSERT INTO usuario(cpf, nome, email, data_nascimento, senha) VALUES('$cpf', '$nome', '$email', '$data_nsc', '$senha')";
$result = $conn->query($sql);

if ($result === TRUE) {
    // Redirecionamento para main_index após o cadastro bem-sucedido
    header("Location: ../main_index/main_index1.php");
    exit();
} else {
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "Erro no cadastro",
            icon: "error"
        }).then(() => {
            history.go(-1);
        });
    </script>
<?php
}
?>

