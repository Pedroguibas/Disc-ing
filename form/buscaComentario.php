<?php
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT
                            comentario.*,
                            usuario.usuarioNome,
                            usuario.usuarioSobrenome,
                            usuario.username
                        FROM comentario
                        LEFT JOIN usuario ON usuario.usuarioID = comentario.comentarioUsuarioID
                        WHERE comentario.comentarioJogoID = :jogoID
                        ORDER BY comentarioData DESC");
$stmt->execute([':jogoID' => $_GET['jogoID']]);
$comentarios = $stmt->fetchAll();
echo json_encode($comentarios);


?>