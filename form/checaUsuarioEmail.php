<?php
include_once("../config/db.php");

$email = htmlspecialchars($_GET['email']);

$stmt = $conn->prepare("SELECT COUNT(*) FROM usuario WHERE email = :email");
$stmt->execute([':email' => $email]);
$check = $stmt->fetch();
echo $check['COUNT(*)'];

?>