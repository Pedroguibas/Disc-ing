<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
session_start();
$_SESSION = array();
header("Location: " . $BASE_URL . "paginasPrincipais/login.php");
?>