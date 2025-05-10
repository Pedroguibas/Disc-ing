<?php
include_once('../config/db.php');

$stmt = $conn->prepare("SELECT * FROM requisitosJogo WHERE requisitosJogoID = :jogoID");
$stmt->execute([':jogoID' => $_POST['j']]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($r);
?>