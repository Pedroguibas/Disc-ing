<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$naLista = $_POST['naLista'];

if ($naLista == NULL) {
    $stmt = $conn->prepare("INSERT INTO lista (jogoID, usuarioID, naLista) VALUES (:jogoID, :usuarioID, 1)");
    $stmt->execute([':jogoID' => $_POST['gameID'],
                    ':usuarioID' => 1]);  // Trocar por id do usuário assim que for possível iniciar sessão
} else if ($naLista) {
    $stmt = $conn->prepare("UPDATE lista SET naLista = 0 WHERE jogoID = :jogoID AND usuarioID = :usuarioID");
    $stmt->execute([':jogoID' => $_POST['gameID'],
                    ':usuarioID' => 1]);  // Trocar por id do usuário assim que for possível iniciar sessão
} else {
    $stmt = $conn->prepare("UPDATE lista SET naLista = 1 WHERE jogoID = :jogoID AND usuarioID = :usuarioID");
    $stmt->execute([':jogoID' => $_POST['gameID'],
                    ':usuarioID' => 1]);  // Trocar por id do usuário assim que for possível iniciar sessão
}

header('Location: ' . $BASE_URL . 'paginasPrincipais/gamePage.php?gameID=' . $_POST['gameID']);
?>