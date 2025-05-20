<?php
include_once('../config/db.php');
$limit = isset($_POST['limit'])? $_POST['limit'] : 99999;
$search = htmlSpecialChars($_POST['search']);

$stmt = $conn->prepare("SELECT usuarioID, usuarioNome, usuarioSobrenome, username FROM usuario WHERE UPPER(username) LIKE UPPER(:search) AND NOT usuarioID = :usuarioID AND banido = 1 LIMIT ".$limit);
$stmt->execute([':search' => $search,
                ':usuarioID' => $_POST['usuarioID']]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
?>