<?php
session_start();
include('../connect.php');

$query = "SELECT * FROM produto";

$result = mysqli_query($conn, $query);
if ($result === false) {
    die("Error executing query: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    echo '<div class="d-flex justify-content-center flex-wrap">';
    $counter = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div id="carouselExampleTouch' . $counter . '" class="carousel slide" data-mdb-touch="false" style="max-width: 400px; margin-right: 20px;">';
        echo '<div class="carousel-inner">';
        echo '<div class="carousel-item active">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" class="d-block w-100" alt="' . htmlspecialchars($row['nome']) . '" style="height: 400px; object-fit: cover;">';
        echo '</div></div>';
        echo '<div class="mt-2">';
        echo '<h5>' . htmlspecialchars($row['nome']) . '</h5>';
        echo '<p>' . htmlspecialchars($row['descricao_']) . '</p>';
        echo '<p>';
        echo '<span>Tamanho: ' . htmlspecialchars($row['tamanho']) . '</span>';
        echo '<span style="float: right;">Preço: R$ ' . htmlspecialchars($row['preco']) . '</span>';
        echo '</p>';
        echo '</div>';
        echo '<button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleTouch' . $counter . '" data-mdb-slide="prev">';
        echo '<span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>';
        echo '<span class="visually-hidden">Previous</span>';
        echo '</button>';
        echo '<button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleTouch' . $counter . '" data-mdb-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>';
        echo '<span class="visually-hidden">Next</span>';
        echo '</button>';

        echo '<form action="add_to_cart.php" method="post">';
        echo '<input type="hidden" name="prod_id" value="' . $row['prod_id'] . '">';
        echo '<button type="submit" class="btn btn-primary mt-3">Adicionar ao Carrinho</button>';
        echo '</form>';

        echo '</div>';

        $counter++;
    }
    echo '</div>';
} else {
    echo '<p>Nenhum produto encontrado</p>';
}
?>
