<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";

include_once('../config/db.php');

$stmt = $conn->prepare("DELETE FROM jogo WHERE jogoID = :id");
$stmt->execute([':id' => $_POST['id']]);


unlink('../assets/Jogos/banner' . $_POST['id'] . '.jpg');
unlink('../assets/Jogos/cover' . $_POST['id'] . '.jpg');

header('Location: ' . $BASE_URL . 'paginasPrincipais/admin/deletarJogo.php');
?>
