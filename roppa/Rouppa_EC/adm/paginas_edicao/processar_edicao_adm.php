<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['excluir']) && $_POST['excluir'] == 1) {
        $id_adm = $_POST['id_adm'];
        $sql_delete = "DELETE FROM adm WHERE id_adm = '$id_adm'";
        if ($conn->query($sql_delete) === TRUE) {
            header("location: editar_adm.php");
        } else {
            echo "Erro ao excluir administrador: " . $conn->error;
        }
    } else {
        
        $id_adm = $_POST['id_adm'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha']; 

        $sql_update = "UPDATE adm SET cpf = '$cpf', senha = '$senha' WHERE id_adm = '$id_adm'";
        
        if ($conn->query($sql_update) === TRUE) {
            header("Location: editar_adm.php");
        } else {
            echo "Erro ao atualizar administrador: " . $conn->error;
        }
    }
}

$conn->close();
?>
