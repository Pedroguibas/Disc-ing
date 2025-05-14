<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT * FROM usuario WHERE (email = :usuario OR username = :usuario) AND senha = :senha");
$stmt->execute([':usuario' => $_POST['usuario'],
                ':senha' => $_POST['senha']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (count($usuario) > 0) {
    session_start();
    $_SESSION['loginStatus'] = 1;
    $_SESSION['usuarioID'] = $usuario['usuarioID'];
    $_SESSION['usuarioNome'] = $usuario['usuarioNome'];
    $_SESSION['usuarioSobrenome'] = $usuario['usuarioSobrenome'];
    $_SESSION['username'] = $usuario['username'];
    $_SESSION['usuarioEmail'] = $usuario['email'];
    $_SESSION['usuarioAdm'] = $usuario['adm'];
    header("Location: " . $BASE_URL . "paginasPrincipais/index.php");
}

?>