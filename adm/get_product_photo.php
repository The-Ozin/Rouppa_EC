<?php
include('../connect.php');

if (isset($_GET['prod_id'])) {
    $prodId = $_GET['prod_id'];
    $query = "SELECT foto FROM produto_fotos WHERE prod_id = '$prodId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        header('Content-Type: image/jpeg');
        echo $row['foto'];
    } else {
        http_response_code(404);
        echo 'Foto não encontrada.';
    }
} else {
    http_response_code(400);
    echo 'ID do produto não fornecido.';
}
