<?php

include('../connect.php');

$query = "SELECT * FROM produto";

$result = mysqli_query($conn, $query);
if ($result === false) {
    die("Error executing query: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    echo '<div class="d-flex justify-content-center">';
    $counter = 1;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($counter % 3 == 1 && $counter != 1) {
            echo '</div><div class="d-flex justify-content-center">';
        }
        echo '<div id="carouselExampleTouch' . $counter . '" class="carousel slide" data-mdb-touch="false" style="max-width: 400px; margin-right: 20px;">';
        echo '<div class="carousel-inner">';
        echo '<div class="carousel-item active">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" class="d-block w-100" alt="' . htmlspecialchars($row['nome']) . '" style="height: 400px; object-fit: cover;">';
        echo '<div class="carousel-caption d-none d-md-block">';
        echo '<h5>' . htmlspecialchars($row['nome']) . '</h5>';
        echo '<p>' . htmlspecialchars($row['descricao_']) . '</p>';
        echo '<p>Tamanho: ' . htmlspecialchars($row['tamanho']) . '</p>';
        echo '<p>Preço: R$ ' . htmlspecialchars($row['preco']) . '</p>';
        echo '</div></div></div>';
        echo '<button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleTouch' . $counter . '" data-mdb-slide="prev">';
        echo '<span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>';
        echo '<span class="visually-hidden">Previous</span>';
        echo '</button>';
        echo '<button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleTouch' . $counter . '" data-mdb-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>';
        echo '<span class="visually-hidden">Next</span>';
        echo '</button></div>';

        $counter++;
    }
    echo '</div>';
} else {
    echo '<p>Nenhum produto encontrado</p>';
}
    
?>
