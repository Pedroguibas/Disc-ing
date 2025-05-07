<?php
session_start();
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$jogado = $_POST['jogado'];

if ($jogado == -1) {
    $stmt = $conn->prepare("INSERT INTO listaJogado (listaJogadoJogoID, listaJogadoUsuarioID, jogado) VALUES (:jogoID, :usuarioID, 1)");
    $stmt->execute([':jogoID' => $_POST['gameID'],
                    ':usuarioID' => $_SESSION['usuarioID']]);
    echo 1;
} elseif ($jogado) {
    $stmt = $conn->prepare("UPDATE listaJogado SET jogado = 0 WHERE listaJogadoJogoID = :jogoID AND listaJogadoUsuarioID = :usuarioID");
    $stmt->execute([':jogoID' => $_POST['gameID'],
                    ':usuarioID' => $_SESSION['usuarioID']]);
    echo 0;
} else {
    $stmt = $conn->prepare("UPDATE listaJogado SET jogado = 1 WHERE listaJogadoJogoID = :jogoID AND listaJogadoUsuarioID = :usuarioID");
    $stmt->execute([':jogoID' => $_POST['gameID'],
                    ':usuarioID' => $_SESSION['usuarioID']]);
    echo 1;
}
?>