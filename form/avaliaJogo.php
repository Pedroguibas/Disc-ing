<?php
session_start();


$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

if ($_GET['avaliado']) {
    $stmt = $conn->prepare("UPDATE avaliacao SET nota = :nota, avaliacaoData = CURRENT_TIMESTAMP WHERE avaliacaoUsuarioID = :usuarioID AND avaliacaoJogoID = :jogoID");
    $stmt->execute([':nota' => $_GET['nota'],
                    ':jogoID' => $_GET['gameID'],
                    ':usuarioID' => $_SESSION['usuarioID']]);
} else {
    $stmt = $conn->prepare("INSERT INTO avaliacao (avaliacaoUsuarioID, avaliacaoJogoID, nota) VALUES (:usuarioID, :jogoID, :nota)");
    $stmt->execute([':nota' => $_GET['nota'],
                    ':jogoID' => $_GET['gameID'],
                    ':usuarioID' => $_SESSION['usuarioID']]);
}

$stmt = $conn->prepare("SELECT SUM(nota) AS nota, COUNT(avaliacaoJogoID) AS total FROM avaliacao WHERE avaliacaoJogoID = :jogoID");
$stmt->execute([':jogoID' => $_GET['gameID']]);

$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($result);
?>