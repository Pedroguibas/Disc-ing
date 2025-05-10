<?php
include_once('../config/db.php');

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM jogo WHERE jogoNome LIKE :search;");
$stmt->execute([':search' => $_POST['search']]);
$total = $stmt->fetch();

echo $total['total'];
?>