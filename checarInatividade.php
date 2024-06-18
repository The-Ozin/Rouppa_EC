<?php
function checarInatividade() {

    $tempoInatividade = 60; 

    if (isset($_SESSION['timeout'])) {
        $tempoSessao = time() - $_SESSION['timeout'];
        if ($tempoSessao > $tempoInatividade) {
            header("Location: http://localhost/Rouppa_EC/logout.php");
            exit();
        }
    }
    $_SESSION['timeout'] = time();
}
