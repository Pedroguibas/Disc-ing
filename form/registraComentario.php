<?php
include_once("../config/db.php");
session_start();

$conteudo = htmlspecialchars($_POST['conteudo']);

$stmt = $conn->prepare("INSERT INTO comentario (conteudo, spoiler, comentarioUsuarioID, comentarioJogoID)
                        VALUES (:conteudo, :spoiler, :comentarioUsuarioID, :comentarioJogoID)");
$stmt->execute([':conteudo' => $conteudo,
                ':spoiler' => $_POST['spoiler'],
                ':comentarioUsuarioID' => $_SESSION['usuarioID'],
                ':comentarioJogoID' => $_POST['jogoID']]);
?>