<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing_2.0/";
session_start();
session_destroy();
header("Location: " . $BASE_URL . "paginasPrincipais/login.php");
?>