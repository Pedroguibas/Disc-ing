<?php
include_once("../config/db.php");

$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['senha']);
$username = htmlspecialchars($_POST['username']);
$nome = htmlspecialchars($_POST['nome']);
$sobrenome = htmlspecialchars($_POST['sobrenome']);

$stmt = $conn->prepare("INSERT INTO usuario (nome, sobrenome, username, email, senha) 
VALUES (:nome, :sobrenome, :username, :email, :senha)");

$stmt->execute([':nome' => $nome,
                ':sobrenome' => $sobrenome,
                ':username' => $username,
                ':email' => $email,
                ':senha' => $senha]);



?>