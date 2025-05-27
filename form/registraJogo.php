<?php
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . "/Disc-ing/";
include_once("../config/db.php");

$requisitos['so'] = trim(htmlspecialchars($_POST['so']));
$requisitos['cpu'] = trim(htmlspecialchars($_POST['cpu']));
$requisitos['gpu'] = trim(htmlspecialchars($_POST['gpu']));
$requisitos['ram'] = trim(htmlspecialchars($_POST['ram']));
$requisitos['armazenamento'] = trim(htmlspecialchars($_POST['armazenamento']));

$jogo['nome'] = trim(htmlspecialchars($_POST['nome']));
$jogo['sinopse'] = htmlspecialchars($_POST['sinopse']);
$jogo['classificacao'] = $_POST['classificacao'];
$plat['switch'] = 0;
$plat['playstation'] = 0;
$plat['xbox'] = 0;
$plat['windowsOS'] = 0;
$plat['macOS'] = 0;
$plat['linuxOS'] = 0;
$plat['androidOS'] = 0;

foreach($_POST['plataforma'] as $plataforma)
    $plat[$plataforma] = 1;


$stmt = $conn->prepare("INSERT INTO requisitosJogo (so, cpu, gpu, ram, armazenamento) VALUES (:so, :cpu, :gpu, :ram, :armazenamento)");
$stmt->execute([':so' => $requisitos['so'],
                ':cpu' => $requisitos['cpu'],
                ':gpu' => $requisitos['gpu'],
                ':ram' => $requisitos['ram'],
                ':armazenamento' => $requisitos['armazenamento']]);

$stmt = $conn->prepare("SELECT requisitosJogoID FROM requisitosJogo ORDER BY requisitosJogoID DESC LIMIT 1");
$stmt->execute();
$reqID = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("INSERT INTO jogo (jogoNome, classificacao, sinopse, jogoRequisitosJogoID, playstation, xbox, nintendoSwitch, windowsOS, macOS, linuxOS, androidOS) VALUES (:nome, :classificacao, :sinopse, :requisitosID, :playstation, :xbox, :nintendoSwitch, :windowsOS, :macOS, :linuxOS, :androidOS)");
$stmt->execute([':nome' => $jogo['nome'],
                ':classificacao' => $jogo['classificacao'],
                ':sinopse' => $jogo['sinopse'],
                ':requisitosID' => $reqID['requisitosJogoID'],
                ':playstation' => $plat['playstation'],
                ':xbox' => $plat['xbox'],
                ':nintendoSwitch' => $plat['switch'],
                ':windowsOS' => $plat['windowsOS'],
                ':macOS' => $plat['macOS'],
                ':linuxOS' => $plat['linuxOS'],
                ':androidOS' => $plat['androidOS']]);

$stmt = $conn->prepare("SELECT jogoID FROM jogo WHERE jogoNome = :jogoNome");
$stmt->execute([':jogoNome' => $jogo['nome']]);
$gameID = $stmt->fetch(PDO::FETCH_ASSOC); //Pega id do jogo que acabou de ser registrado no banco para usar nos nomes das imagens
$gameID = $gameID['jogoID'];

$diretorio = '../assets/Jogos/';
$banner = $diretorio . basename($_FILES['banner']['name']);
move_uploaded_file($_FILES['banner']['tmp_name'], $banner);
rename($banner, $diretorio . 'banner' . $gameID . '.jpg');

$cover = $diretorio . basename($_FILES['cover']['name']);
move_uploaded_file($_FILES['cover']['tmp_name'], $cover);
rename($cover, $diretorio . 'cover' . $gameID . '.jpg');

header("Location: " . $BASE_URL . 'paginasPrincipais/gamePage.php?gameID=' . $gameID);

?>