<?php

include "connect.php";

 $excluir=$_POST['excluir'];

if($excluir == '1'){
    $cpf=$_POST['cpf'];
    $sql="DELETE FROM usuario WHERE cpf = '$cpf' ";
    if ($conn->query($sql) === TRUE) {
        echo "Registro deletado com sucesso!";
    } else {
        echo "Erro ao deletar registro: " . $conn->error;
    }
}

elseif(isset($_POST['cpf']) && isset($_POST['nome']) && isset($_POST['email'])) {

    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $query = "UPDATE usuario SET nome = ?, email = ? WHERE cpf = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("sss", $nome, $email, $cpf);

    if($stmt->execute()) {

        header("Location: edição_usuario.php");
        exit();
    } else {

        echo "Erro ao processar a edição do usuário.";
    }
}
 else {

    echo "Dados do formulário incompletos.";
}
?>
