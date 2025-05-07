<?php
include_once("../config/db.php");

$email = htmlspecialchars($_POST['email']);

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM usuario WHERE email = :email");
$stmt->execute([':email' => $email]);
$check = $stmt->fetch(PDO::FETCH_ASSOC);
echo $check['total'];

?>