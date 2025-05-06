<?php
session_start();
include_once('../config/db.php');

if ($_POST['liked'] == 1) {
    $stmt = $conn->prepare("UPDATE usuarioLikeComentario
                            SET liked = 0
                            WHERE likeUsuarioID = :usuarioID
                            AND likeComentarioID = :comentarioID;");
    $stmt->execute([':usuarioID' => $_SESSION['usuarioID'],
                    ':comentarioID' => $_POST['comentarioID']]);

    $stmt = $conn->prepare("UPDATE comentario SET likes = likes - 1 WHERE comentarioID = :comentarioID");
    $stmt->execute([':comentarioID' => $_POST['comentarioID']]);
} else if ($_POST['liked'] == 0) {
    
    $stmt = $conn->prepare("UPDATE usuarioLikeComentario
                            SET liked = 1
                            WHERE likeUsuarioID = :usuarioID
                            AND likeComentarioID = :comentarioID;");

    $stmt->execute([':usuarioID' => $_SESSION['usuarioID'],
                    ':comentarioID' => $_POST['comentarioID']]);

    $stmt = $conn->prepare("UPDATE comentario SET likes = likes + 1 WHERE comentarioID = :comentarioID");
    $stmt->execute([':comentarioID' => $_POST['comentarioID']]);

} else {
    $stmt = $conn->prepare("INSERT INTO usuarioLikeComentario (likeUsuarioID, likeComentarioID) VALUES (:usuarioID, :comentarioID)");
    $stmt->execute([':usuarioID' => $_SESSION['usuarioID'],
                    ':comentarioID' => $_POST['comentarioID']]);

    $stmt = $conn->prepare("UPDATE comentario SET likes = likes + 1 WHERE comentarioID = :comentarioID");
    $stmt->execute([':comentarioID' => $_POST['comentarioID']]);
}
?>