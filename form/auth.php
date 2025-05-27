<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../config/db.php");

$stmt = $conn->prepare("SELECT * FROM usuario WHERE (email = :usuario OR username = :usuario) AND senha = MD5(:senha)");
$stmt->execute([':usuario' => $_POST['usuario'],
                ':senha' => $_POST['senha']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($usuario) && count($usuario) > 0) {
    session_start();
    $_SESSION['loginStatus'] = 1;
    $_SESSION['usuarioID'] = $usuario['usuarioID'];
    $_SESSION['usuarioNome'] = $usuario['usuarioNome'];
    $_SESSION['usuarioSobrenome'] = $usuario['usuarioSobrenome'];
    $_SESSION['username'] = $usuario['username'];
    $_SESSION['usuarioEmail'] = $usuario['email'];
    $_SESSION['usuarioAdm'] = $usuario['adm'];

    if ($usuario['banido'] == 0) {
        $_SESSION['banido'] = 0;
        header("Location: " . $BASE_URL . "paginasPrincipais/index.php");
    } else {
        $_SESSION['banido'] = 1;
        header("Location: " . $BASE_URL . "paginasPrincipais/bannedUser.php");
    }
} else {
    header("Location: " . $BASE_URL . "paginasPrincipais/login.php");
}

?>