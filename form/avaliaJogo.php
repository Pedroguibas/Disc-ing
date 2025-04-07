<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

if ($_POST['avaliado'] == 1) {
    $stmt = $conn->prepare("UPDATE avaliacao SET nota = :nota WHERE usuarioID = :usuarioID");
    $stmt->execute([':nota' => $_POST['nota'],
                    ':usuarioID' => 1]); // Trocar por id do usuário assim que for possível iniciar sessão
} else {
    $stmt = $conn->prepare("INSERT INTO avaliacao (usuarioID, jogoID, nota) VALUES (:usuarioID, :jogoID, :nota)");
    $stmt->execute([':nota' => $_POST['nota'],
                    ':jogoID' => $_POST['gameID'],
                    ':usuarioID' => 1]); // Trocar por id do usuário assim que for possível iniciar sessão
}


header("Location: " . $BASE_URL . 'paginasPrincipais/gamePage.php?gameID=' . $_POST['gameID']);

?>