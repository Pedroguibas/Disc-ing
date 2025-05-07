<?php
session_start();
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT
                            C.*,
                            U.usuarioNome,
                            U.usuarioSobrenome,
                            U.username,
                            ULC.liked
                        FROM comentario C
                        LEFT JOIN usuario U ON U.usuarioID = C.comentarioUsuarioID
                        LEFT JOIN usuarioLikeComentario ULC ON ULC.likeUsuarioID = :usuarioID AND ULC.likeComentarioID = C.comentarioID
                        WHERE C.comentarioJogoID = :jogoID
                        ORDER BY C.comentarioData DESC");

$stmt->execute([':usuarioID' => $_SESSION['usuarioID'],
                ':jogoID' => $_POST['jogoID'],]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$listaJogado = [];
foreach($comentarios as $comentario) {
    if ($comentario['liked'] === NULL)
        $comentario['liked'] = -1;
    array_push($listaJogado, $comentario);
}
echo json_encode($listaJogado);


?>