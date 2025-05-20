<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once('../config/db.php');

$stmt = $conn->prepare("UPDATE usuario SET banido = 1 WHERE usuarioID = :usuarioID");
$stmt->execute([':usuarioID' => $_POST['userID']]);

header('Location: ' . $BASE_URL . 'paginasPrincipais/admin/banUser.php');
?>