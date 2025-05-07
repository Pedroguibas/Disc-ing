<?php
include_once('../config/db.php');

$username = htmlspecialchars($_POST['username']);

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM usuario WHERE username = :username");
$stmt->execute([':username' => $username]);
$username = $stmt->fetch(PDO::FETCH_ASSOC);

echo $username['total'];

?>