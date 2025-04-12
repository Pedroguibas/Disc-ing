<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

if ($_GET['avaliado']) {
    $stmt = $conn->prepare("UPDATE avaliacao SET nota = :nota WHERE usuarioID = :usuarioID AND jogoID = :jogoID");
    $stmt->execute([':nota' => $_GET['nota'],
                    ':jogoID' => $_GET['gameID'],
                    ':usuarioID' => 1]); // Trocar por id do usuário assim que for possível iniciar sessão
} else {
    $stmt = $conn->prepare("INSERT INTO avaliacao (usuarioID, jogoID, nota) VALUES (:usuarioID, :jogoID, :nota)");
    $stmt->execute([':nota' => $_GET['nota'],
                    ':jogoID' => $_GET['gameID'],
                    ':usuarioID' => 1]); // Trocar por id do usuário assim que for possível iniciar sessão
}

$stmt = $conn->prepare("SELECT SUM(nota) AS nota, COUNT(*) AS total FROM avaliacao WHERE jogoID = :jogoID");
$stmt->execute([':jogoID' => $_GET['gameID']]);

$result = $stmt->fetch();
echo $result['nota'] / $result['total'];
?>