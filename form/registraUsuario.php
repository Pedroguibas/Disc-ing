<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
include_once("../config/db.php");

$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['senha']);
$username = htmlspecialchars($_POST['username']);
$nome = htmlspecialchars($_POST['nome']);
$sobrenome = htmlspecialchars($_POST['sobrenome']);

$stmt = $conn->prepare("INSERT INTO usuario (usuarioNome, usuarioSobrenome, username, email, senha) 
VALUES (:nome, :sobrenome, :username, :email, :senha)");

$stmt->execute([':nome' => $nome,
                ':sobrenome' => $sobrenome,
                ':username' => $username,
                ':email' => $email,
                ':senha' => $senha]);

header("Location: " . $BASE_URL . "paginasPrincipais/login.php");

?>