<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM usuario WHERE (email = :usuario OR username = :usuario) AND senha = :senha");
$stmt->execute([':usuario' => $_POST['usuario'],
                ':senha' => $_POST['senha']]);
$check = $stmt->fetch(PDO::FETCH_ASSOC);

echo $check['total'];


?>