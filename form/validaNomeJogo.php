<?php
include_once('../config/db.php');

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM jogo WHERE jogoNome = :nome");
$stmt->execute([':nome' => $_GET['nome']]);
$total = $stmt->fetch();

echo $total['total'];

?>