<?php
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT * FROM comentario WHERE comentarioJogoID = :jogoID ORDER BY comentarioData DESC");
$stmt->execute([':jogoID' => $_GET['jogoID']]);
$comentarios = $stmt->fetchAll();
echo json_encode($comentarios);


?>