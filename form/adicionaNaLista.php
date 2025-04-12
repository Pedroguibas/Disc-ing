<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$naLista = $_GET['naLista'];

if ($naLista == -1) {
    $stmt = $conn->prepare("INSERT INTO lista (jogoID, usuarioID, naLista) VALUES (:jogoID, :usuarioID, 1)");
    $stmt->execute([':jogoID' => $_GET['gameID'],
                    ':usuarioID' => 1]);  // Trocar por id do usuário assim que for possível iniciar sessão
    echo 1;
} elseif ($naLista) {
    $stmt = $conn->prepare("UPDATE lista SET naLista = 0 WHERE jogoID = :jogoID AND usuarioID = :usuarioID");
    $stmt->execute([':jogoID' => $_GET['gameID'],
                    ':usuarioID' => 1]);  // Trocar por id do usuário assim que for possível iniciar sessão
    echo 0;
} else {
    $stmt = $conn->prepare("UPDATE lista SET naLista = 1 WHERE jogoID = :jogoID AND usuarioID = :usuarioID");
    $stmt->execute([':jogoID' => $_GET['gameID'],
                    ':usuarioID' => 1]);  // Trocar por id do usuário assim que for possível iniciar sessão
    echo 1;
}
?>