<?php
include_once("../config/db.php");

$conteudo = htmlspecialchars($_GET['conteudo']);

$stmt = $conn->prepare("INSERT INTO comentario (conteudo, spoiler, comentarioUsuarioID, comentarioJogoID)
                        VALUES (:conteudo, :spoiler, :comentarioUsuarioID, :comentarioJogoID)");
$stmt->execute([':conteudo' => $conteudo,
                ':spoiler' => $_GET['spoiler'],
                ':comentarioUsuarioID' => $_GET['usuarioID'],
                ':comentarioJogoID' => $_GET['jogoID']]);
?>