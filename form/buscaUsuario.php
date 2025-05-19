<?php
include_once('../config/db.php');
$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
$search = htmlSpecialChars($_POST['search']);

$stmt = $conn->prepare("SELECT usuarioID, usuarioNome, usuarioSobrenome, username FROM usuario WHERE UPPER(username) LIKE UPPER(:search) LIMIT ".$limit);
$stmt->execute([':search' => $search]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
?>